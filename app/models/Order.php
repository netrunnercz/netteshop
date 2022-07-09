<?php

class Order extends BaseModel {
	//private $table = "shop_orders";
	//private $table
	//private $orderId;
					
	function __construct(Nette\Database\Connection $connection, $orderId = 0) {
		parent::__construct($connection);
		//if($orderId != 0)
		//	$this->orderId = intval($orderId);
	}
	
	public function create($firstname, $lastname, $street, $city, $zip, $country, $email, $phone) {
		$date = new DateTime();
		
		$number = $this->database->table("shop_order")->select("number")->where("year", $date->format("Y"))->order("number DESC")->limit(1);
		if(count($number))
			$nextNumber = $number->fetch()->number + 1;
		else
			$nextNumber = 1;
		
		$row = $this->database->table("shop_order")->insert(array(
				"customer_firstname" => $firstname,
				"customer_lastname" => $lastname,
				"customer_street" => $street,
				"customer_city" => $city,
				"customer_zip" => preg_replace("~\s+~ui", "", $zip),
				"customer_country" => $country,
				"customer_email" => $email,
				"customer_phone" => $phone,
				"year" => $date->format("Y"),
				"ordered" => $date,
				"number" => $nextNumber
		));
		
		return $row["id"];
	}
	
	public function createSms($smsAddress, $phone) {
		$date = new DateTime();
		
		$number = $this->database->table("shop_order")->select("number")->where("year", $date->format("Y"))->order("number DESC")->limit(1);
		if(count($number))
			$nextNumber = $number->fetch()->number + 1;
		else
			$nextNumber = 1;
		
		$row = $this->database->table("shop_order")->insert(array(
				"sms_address" => $smsAddress,
				"customer_phone" => $phone,
				"year" => $date->format("Y"),
				"ordered" => $date,
				"number" => $nextNumber
		));
		
		return $row["id"];
	}
	
	public function setPayment($id, $payment) {
		$this->database->table("shop_order")->where("id", $id)->update(array("payment" => $payment));
	}
	
	public function setPostage($id, $postage) {
		$postage = $this->database->query("
			SELECT shop_postage.id, shop_postage.price_czk, shop_vat_rate.rate
			FROM shop_postage, shop_vat_rate
			WHERE shop_postage.id = ? AND shop_postage.vat_rate_id = shop_vat_rate.id", $postage)->fetch();

		$this->database->table("shop_order_postage")->insert(array(
				"order" => $id,
				"postage" => $postage["id"],
				"price_czk" => $postage["price_czk"],
				"vat_rate" => $postage["rate"]
		));
	}
	
	public function insertItems($id, $items = array()) {
		$products = $this->database->query("
			SELECT shop_product.id, shop_product.price_czk, shop_vat_rate.rate
			FROM shop_product, shop_vat_rate
			WHERE shop_product.vat_rate_id = shop_vat_rate.id AND shop_product.id IN ( ? )", array_keys($items));

		$insert = array();
		foreach($products as $product) {
			$insert[] = array(
					"order" => $id,
					"product" => $product["id"],
					"price_czk" => $product["price_czk"],
					"vat_rate" => $product["rate"],
					"quantity" => $items[$product["id"]]
					);
		}

		$this->database->table("shop_order_item")->insert($insert);
	}
	
	public function getInformation($id) {
		$order = $this->database->query("
			SELECT shop_order.*, SUM(shop_order_item.price_czk*shop_order_item.quantity) + shop_order_postage.price_czk AS total, shop_order_postage.price_czk AS postage, shop_order_postage.vat_rate AS postage_vat_rate
			FROM shop_order, shop_order_item, shop_order_postage
			WHERE shop_order.id = shop_order_item.order
			AND shop_order.id = shop_order_postage.order
			AND shop_order.id = ?", $id)->fetch();

		return $order;
	}
	
	public function getItems($id) {
		$selection = $this->database->query("
			SELECT shop_order_item.*, shop_product.name, shop_product.id AS pid, (SELECT id FROM shop_product_image WHERE product_id = shop_product.id AND main = 1) mainImage
			FROM shop_order_item, shop_product
			WHERE shop_order_item.product = shop_product.id AND shop_order_item.order = ?", $id);

		$return = array();
		foreach($selection as $row)
			$return[] = $row;

		return $return;
	}
	
	public function getList($limit = NULL, $offset = NULL) {
		$sql = "SELECT shop_order.*, SUM(shop_order_item.price_czk*shop_order_item.quantity) + shop_order_postage.price_czk AS total
				FROM shop_order, shop_order_item, shop_order_postage
				WHERE shop_order.id = shop_order_item.order
				AND shop_order.id = shop_order_postage.order
				GROUP BY shop_order.id
				ORDER BY shop_order.id DESC";
		
		$args = array();
		if(!is_null($limit) && !is_null($offset)) {
			$sql .= " LIMIT ?, ?";
			$args[] = $offset;
			$args[] = $limit;
		}
		elseif(!is_null($limit)) {
			$sql = " LIMIT ?";
			$args[] = $limit;
		}
		
		$selection = $this->database->queryArgs($sql, $args)->fetchAll();
		
		return $selection;
	}
	
	public function getCountByStatus($status = NULL) {
		$sql = "SELECT Count(*) AS total FROM shop_order";
		$args = array();
		if(!is_null($status)) {
			$sql .= " WHERE status = ? ";
			$args[] = $status;
		}
		
		$selection = $this->database->queryArgs($sql, $args)->fetch();
		
		return $selection["total"];
	}
	
	public function getPaidUnshipped() {
		$sql = "SELECT shop_order.*, SUM(shop_order_item.price_czk*shop_order_item.quantity) + shop_order_postage.price_czk AS total
				FROM shop_order, shop_order_item, shop_order_postage
				WHERE shop_order.id = shop_order_item.order
				AND shop_order.id = shop_order_postage.order
				AND shop_order.paid IS NOT NULL
				AND shop_order.shipped IS NULL
				GROUP BY shop_order.id
				ORDER BY shop_order.id DESC";
		$selection = $this->database->query($sql)->fetchAll();
		
		return $selection;
	}
	
	public function getPayOnDelivery($shipped = false) {
		$sql = "SELECT shop_order.*, SUM(shop_order_item.price_czk*shop_order_item.quantity) + shop_order_postage.price_czk AS total
				FROM shop_order, shop_order_item, shop_order_postage
				WHERE shop_order.id = shop_order_item.order
				AND shop_order.id = shop_order_postage.order
				AND shop_order.payment = 'dobirka'
				AND shop_order.shipped IS ".($shipped ? " NOT " : "")." NULL
				AND shop_order.paid IS NULL
				GROUP BY shop_order.id
				ORDER BY shop_order.id DESC";
		$selection = $this->database->query($sql)->fetchAll();
		
		return $selection;
	}
	
	public function setPaid($order_id = array()) {
		$this->database->table("shop_order")->where("id", $order_id)->update(array("paid" => new \Nette\Database\SqlLiteral('NOW()')));
	}
	
	public function setShipped($order_id = array()) {
		$this->database->table("shop_order")->where("id", $order_id)->update(array("status" => 3, "shipped" => new \Nette\Database\SqlLiteral('NOW()')));
	}
	
	public function getFullById($id) {
		$sql = "SELECT shop_order.*, SUM(shop_order_item.price_czk*shop_order_item.quantity) + shop_order_postage.price_czk AS total, shop_order_postage.price_czk AS postage, shop_order_postage.vat_rate AS postage_vat_rate
				FROM shop_order, shop_order_item, shop_order_postage
				WHERE shop_order.id = shop_order_item.order
				AND shop_order.id = shop_order_postage.order
				AND shop_order.id IN (?)
				GROUP BY shop_order.id
				ORDER BY shop_order.id DESC";
		$selection = $this->database->query($sql, $id);
		
		$orders = array();
		foreach($selection->fetchAll() as $single) {
			$orders[] = array_merge($single->getIterator()->getArrayCopy(), array("items" => $this->getItems($single["id"])));
		}
		
		return $orders;
	}
}

