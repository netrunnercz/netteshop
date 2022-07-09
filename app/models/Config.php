<?php

class Config extends BaseModel {
	private $data = array();
	
	public function __construct(Nette\Database\Connection $connection) {
		parent::__construct($connection);
		
		$this->load();
	}
	
	/**
	 * Loads configuration from database. Also tries to set correct type for values.
	 */
	public function load() {
		$selection = $this->database->table("shop_config")->select("name, value");
		$this->data = array();
		foreach($selection as $row) {
			if(intval($row["value"]) == $row["value"])
				$this->data[$row["name"]] = intval($row["value"]);
			elseif(floatval($row["value"]) == $row["value"])
				$this->data[$row["name"]] = floatval($row["value"]);
			else
				$this->data[$row["name"]] = $row["value"];
		}
	}
	
	public function &__get($name)	{
		if(array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		
		return parent::__get($name);
	}
	
	/**
	 * Update single configuration value, create if not exists
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return bool Database update result
	 */
	public function set($name, $value) {
		if(array_key_exists($name, $this->data)) {
			if($this->data[$name] != $value)
				return $this->database->table("shop_config")->where("name", $name)->update(array("value" => $value));
			else
				return true;
		}
		else {
			if($this->database->table("shop_config")->insert(array("name" => $name, "value" => $value))) {
				$this->data[$name] = $value;
				return true;	
			}
			else
				return false;
		}
	}
}

