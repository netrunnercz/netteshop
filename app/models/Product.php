<?php

class Product extends BaseModel {

	private $table = "shop_product";
	
	public function __construct(Nette\Database\Connection $connection) {
		parent::__construct($connection);
	}
	
	public function findById($id = NULL) {
		if(is_null($id))
			return;
		
		//$selection = $this->database->table("shop_product")->select("shop_product.*")->where("product_image.product_id", $id)->order("product_image.main DESC")->limit(1);
		
		$selection = $this->database->query("
																		SELECT p.*, (SELECT id FROM shop_product_image WHERE product_id = p.id AND main = 1) mainImage
																		FROM shop_product p
																		WHERE p.id IN (?)
																		ORDER BY id DESC", $id);
//table($this->table)->where("id", $id);
		if(is_array($id))
			return $selection->fetchAll();
		else
			return $selection->fetch();
	}
	
	public function getCurrentIssue() {
		$sql = "SELECT p.*, (SELECT id FROM shop_product_image WHERE product_id = p.id AND main = 1) mainImage
					FROM shop_product p
					LEFT JOIN shop_product_to_category pc ON p.id = pc.product_id
					LEFT JOIN shop_category c ON pc.category_id = c.id
					WHERE c.id = 1
					AND p.price_czk < 100
					ORDER BY p.id DESC
					LIMIT 1";
		
		$selection = $this->database->query($sql)->fetchAll();
		return $selection;
	}
	
	public function findByCategory($category = NULL, $getTotal = false, $orderBy = NULL, $orderWay = NULL, $limit = NULL, $offset = NULL, $disabled = false) {
		
		if($getTotal)
			$select = "COUNT(*)";
		else
			$select = "p.*, (SELECT id FROM shop_product_image WHERE product_id = p.id AND main = 1) mainImage";
		
		$sql = "SELECT ".$select."
					FROM shop_product p
					LEFT JOIN shop_product_to_category pc ON p.id = pc.product_id
					LEFT JOIN shop_category c ON pc.category_id = c.id";
		
		$where = array();
		$args = array();
		
		if(!$disabled) {
			$where[] = " p.status = ? ";
			$args[] = 1;
		}
		
		if(!is_null($category)) {
			$where[] = " c.id = ? ";
			$args[] = $category;
		}
		
		//$where[] = " i.main = 1 ";
		
		if($where)
			$sql .= " WHERE ".implode(" AND ", $where);
		
		if($getTotal) {
			$result = $this->database->queryArgs($sql, $args)->fetch();
			return $result["COUNT(*)"];
		}
		
		$sql .= " GROUP BY p.id ";
		
		$order = array();
		if($orderBy == "random")
			$order[] = " RAND() ";
		elseif(!is_null($orderBy))
			$order[] = " p.".$orderBy." ".strtoupper($orderWay)." ";
		
		if($order)
			$sql .= " ORDER BY ".implode(",", $order)." ";
		
		if(!is_null($limit) && !empty($offset)) {
			$sql .= " LIMIT ?, ? ";
			$args[] = $offset;
			$args[] = $limit;
		}
		elseif(!is_null($limit)) {
			$sql .= " LIMIT ? ";
			$args[] = $limit;
		}

		$selection = $this->database->queryArgs($sql, $args)->fetchAll();
		
		return $selection;
	}
	
	public function findByKeyword($keyword, $getTotal = false, $limit = NULL, $offset = NULL) {
		if($getTotal)
			$select = "COUNT(*)";
		else
			$select = "p.*, (SELECT id FROM shop_product_image WHERE product_id = p.id AND main = 1) mainImage";
		
		$sql = "SELECT ".$select.", 
						((MATCH(p.name) AGAINST(? IN BOOLEAN MODE))*5 + (MATCH(p.description_long) AGAINST(? IN BOOLEAN MODE))) AS score
						FROM shop_product p
						WHERE p.status = 1 AND MATCH(p.name, p.description_long) AGAINST(? IN BOOLEAN MODE)
						ORDER BY score DESC";
		
		$args = array($keyword."*", $keyword."*", $keyword."*");
		
		if($getTotal) {
			$result = $this->database->queryArgs($sql, $args)->fetch();
			return $result["COUNT(*)"];
		}
		
		if(!is_null($limit) && !empty($offset)) {
			$sql .= " LIMIT ?, ? ";
			$args[] = $offset;
			$args[] = $limit;
		}
		elseif(!is_null($limit)) {
			$sql .= " LIMIT ? ";
			$args[] = $limit;
		}
		
		$selection = $this->database->queryArgs($sql, $args);
		
		return $selection->fetchAll();
	}
	
	public function edit($product_id, $data) {
		if(isset($data["mainImage"]) || is_null($data["mainImage"])) {
			if(!is_null($data["mainImage"])) {
				$this->database->table("shop_product_image")->where("product_id", $product_id)->update(array("main" => 0));
				$this->database->table("shop_product_image")->where(array("product_id" => $product_id, "id" => $data["mainImage"]))->update(array("main" => 1));
			}
			unset($data["mainImage"]);
		}
		$update = array();
		foreach($data as $key => $val)
			if(!is_array($val))
				$update[$key] = $val;
			
		$this->database->table("shop_product")->where("id", $product_id)->update($update);
		
		$this->deleteRelations($product_id);
		$this->editRelations($product_id, $data);
		
		return true;
	}
	
	public function deleteRelations($product_id) {
		$this->database->table("shop_product_to_category")->where("product_id", $product_id)->delete();
		return true;
	}
	
	public function editRelations($product_id, $data) {
		foreach ($data["category"] as $category_id) {
			$this->database->table("shop_product_to_category")->insert(array("product_id" => $product_id, "category_id" => $category_id));
		}
		
		return true;
	}
	
	public function create($data) {
		$insert = array();
		foreach($data as $key => $val)
			if(!is_array($val))
				$insert[$key] = $val;
		$row = $this->database->table("shop_product")->insert($insert);
		
		$this->editRelations($row["id"], $data);
		
		return $row["id"];
	}
	
	public function getImages($product_id) {
		$selection = $this->database->table("shop_product_image")->select("*")->where(array("product_id" => $product_id));
		
		return $selection;
	}
	
	public function addImage($product_id, $path) {
		$row = $this->database->table("shop_product_image")->insert(array("product_id" => $product_id));
		
		$largeImage = Nette\Image::fromFile($path);
		$largeImage->resize(300, 300, Nette\Image::SHRINK_ONLY);
		$largeImage->save(WWW_DIR."/i/large/".$product_id."-".$row["id"].".jpg", 80, Nette\Image::JPEG);
		
		$mediumImage = Nette\Image::fromFile($path);
		$mediumImage->resize(200, 200, Nette\Image::SHRINK_ONLY);
		//$mediumImage->sharpen();
		$mediumImage->save(WWW_DIR."/i/medium/".$product_id."-".$row["id"].".jpg", 80, Nette\Image::JPEG);
		
		$smallImage = Nette\Image::fromFile($path);
		$smallImage->resize(80, 80, Nette\Image::SHRINK_ONLY);
		//$smallImage->sharpen();
		$smallImage->save(WWW_DIR."/i/small/".$product_id."-".$row["id"].".jpg", 80, Nette\Image::JPEG);
		
		$total = $this->database->table("shop_product_image")->select("COUNT(*) t")->where("product_id", $product_id)->fetch();
		if($total["t"] == 1)
			$this->database->table("shop_product_image")->where("id", $row["id"])->update(array("main" => 1));
	}
	
	public function getCategories($product_id) {
		$sql = "SELECT c.id, c.name, c.nicename, c.path
						FROM shop_product_to_category pc, shop_category c, shop_category parent
						WHERE c.lft BETWEEN parent.lft AND parent.rgt
						AND pc.category_id = c.id
						AND pc.product_id = ?
						GROUP BY c.id
						ORDER BY c.lft";
		
		$selection = $this->database->query($sql, $product_id)->fetchAll();
		/*$selection = $this->database->table("shop_product_to_category")->select("category_id")->where("product_id", $product_id);
		
		$return = array();
		foreach($selection as $row)
			$return[] = $row["category_id"];*/
		
		return $selection;
	}
		
	public function getDeepestCategory($product_id) {
		$sql = "SELECT c.id, c.name, c.nicename, c.path, (COUNT(parent.name)-1) depth
						FROM shop_category c, shop_category parent
						WHERE c.lft BETWEEN parent.lft AND parent.rgt
						AND c.id IN (?)
						GROUP BY c.id
						ORDER BY depth DESC
						LIMIT 1";
		
		$selection = $this->database->query($sql, $this->getCategories($product_id))->fetch();
		
		return $selection;
	}
}
