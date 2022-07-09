<?php

class Cart extends BaseModel {
	private $cart = array();
	private $products_table = "shop_product";
	
	public function __construct(Nette\Database\Connection $connection, Nette\Http\Session $session) {
		parent::__construct($connection);
		//if(is_array($session->getSection("cart")))
			$this->cart = $session->getSection("cart");		
	}

	public function add($item, $quantity = 1) {
		if(isset($this->cart[$item])) {
			$quantity += $this->cart[$item];
		}
		
		$this->cart[$item] = $quantity;
	}

	public function alter($item, $quantity) {
		if(isset($this->cart[$item])) {
			$this->cart[$item] = intval($quantity);
		}
	}

	public function delete($item) {
		unset($this->cart[$item]);
	}

	public function getCart() {
		return $this->cart->getIterator()->getArrayCopy();
	}
	
	public function getTotalquantity() {
		$total = 0;
		foreach($this->cart->getIterator()->getArrayCopy() as $item) {
			$total += $item;
		}
		return $total;
	}
	
	public function getTotalPrice() {
		$selection = $this->database->table($this->products_table)->select("id, price_czk")->where("id", array_keys($this->cart->getIterator()->getArrayCopy()));
		$total = 0;
		
		foreach($selection AS $product)
			$total += $product["price_czk"] * $this->cart[$product["id"]];
		
		return $total;
	}
	
	public function clean() {
		foreach($this->cart->getIterator()->getArrayCopy() as $item => $quantity) {
			unset($this->cart[$item]);
		}
	}
}
