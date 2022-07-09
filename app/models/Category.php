<?php

class Category extends BaseModel {
	
	private $table = "shop_category";
	
	public function __construct(Nette\Database\Connection $connection) {
		parent::__construct($connection);
	}
	
	public function findById($id = NULL) {
		if(is_null($id))
			return;
		
		return $this->findBy("id", $id);
	}
	
	function findByNicename($nicename) {
		if(is_null($nicename))
			return;
		
		return $this->findBy("nicename", $nicename);
	}
	
	function findByPath($path) {
		if(is_null($path))
			return;
		
		return $this->findBy("path", $path);
	}
	
	public function findBy($by = NULL, $value = NULL) {
		if(is_null($by) || is_null($value))
			return;
		
		$selection = $this->database->table($this->table);
		$selection->where($by, $value);
		
		return $selection->fetch();
	}
	
	public function listAll($orderBy = NULL, $orderWay = 'ASC', $parent = NULL) {
		$selection = $this->database->table($this->table);
		
		/*if(!is_null($parent))
			$selection->where("parent", $parent);*/
		
		if($orderBy == "random")
			$selection->order("RAND()");
		elseif(!is_null($orderBy))
			$selection->order($orderBy.' '.$orderWay);
		
		
		return $selection;
	}
	
	public function getLineByPath($path) {
		$sql = "SELECT parent.*
						FROM shop_category c, shop_category AS parent
						WHERE c.lft BETWEEN parent.lft AND parent.rgt
						AND c.path = ?
						ORDER BY parent.lft";
		
		$selection = $this->database->query($sql, $path)->fetchAll();
		
		return $selection;
	}
	
	public function getTree($indentation = '') {
		$sql = "SELECT c.id, c.name, c.nicename, c.path, (COUNT(parent.name)-1) depth
						FROM shop_category c, shop_category parent
						WHERE c.lft BETWEEN parent.lft AND parent.rgt
						GROUP BY c.id
						ORDER BY c.lft";
		
		$selection = $this->database->query($sql)->fetchAll();
		
		$list = array();
		foreach($selection as $row)
			$list[] = array_merge($row->getIterator()->getArrayCopy(), array("intendedName" => str_repeat($indentation, $row["depth"]).$row["name"]));
		
		return $list;
	}
	
	private function writePath($category_id) {
		$sql = "SELECT parent.nicename
						FROM shop_category c, shop_category AS parent
						WHERE c.lft BETWEEN parent.lft AND parent.rgt
						AND c.id = ?
						ORDER BY parent.lft";
		
		$selection = $this->database->query($sql, $category_id)->fetchAll();
		
		$path = array();
		foreach($selection as $node)
			$path[] = $node["nicename"];
		
		$this->database->table("shop_category")->where("id", $category_id)->update(array("path" => implode("/", $path)));
		
		return true;
	}
	
	public function edit($category_id, $data) {
		$current = $this->table("shop_category")->select("*")->where("id", $category_id)->fetch();
		if($current["parent"] == $data["parent"]) {
			$this->database->table("shop_category")->where("id", $category_id)->update($data);
		} else {
			if($current["lft"] == $current["rgt"] - 1) {
				$this->database->table("shop_category")->where("lft > ?", $current["lft"])->update(array("lft" => new \Nette\Database\SqlLiteral("lft - 2")));
				$this->database->table("shop_category")->where("rgt > ?", $current["rgt"])->update(array("rgt" => new \Nette\Database\SqlLiteral("rgt - 2")));
				$newParent = $this->database->table("shop_category")->select("*")->where("id", $data["parent"])->fetch();
				$this->database->table("shop_category")->where("lft > ?", $newParent["lft"])->update(array("lft" => new \Nette\Database\SqlLiteral("lft + 2")));
				$this->database->table("shop_category")->where("rgt > ?", $newParent["lft"])->update(array("rgt" => new \Nette\Database\SqlLiteral("rgt + 2")));
				$this->database->table("shop_category")->where("id", $category_id)->update(array("lft" => $newParent["lft"]+1, "rgt" => $newParent["lft"]+2, "parent" => $newParent["id"]));
			}
		}
		
		$this->writePath($category_id);
		
		return true;
	}
	
	public function create($data) {
		if($data["parent"]) {
			$parent = $this->database->table("shop_category")->select("*")->where("id", $data["parent"])->fetch();
			$this->database->table("shop_category")->where("lft > ?", $parent["lft"])->update(array("lft" => new \Nette\Database\SqlLiteral("lft + 2")));
			$this->database->table("shop_category")->where("rgt > ?", $parent["lft"])->update(array("rgt" => new \Nette\Database\SqlLiteral("rgt + 2")));
			$data["lft"] = $parent["lft"]+1;
			$data["rgt"] = $parent["lft"]+2;
			$row = $this->database->table($this->table)->insert($data);
		} else {
			$max = $this->database->table("shop_category")->select("max(rgt) r")->fetch();
			$data["lft"] = $max["r"]+1;
			$data["rgt"] = $max["r"]+2;
			$row = $this->database->table($this->table)->insert($data);
		}
		
		$this->writePath($row["id"]);
		
		return $row["id"];
	}
	
	public function delete($category_id) {
		$current = $this->database->table("shop_category")->select("*")->where("id", $category_id)->fetch();
		if($current["lft"]+1 == $current["rgt"]) {
			$this->database->table("shop_category")->where("lft > ?", $current["lft"])->update(array("lft" => new \Nette\Database\SqlLiteral("lft - 2")));
			$this->database->table("shop_category")->where("rgt > ?", $current["rgt"])->update(array("rgt" => new \Nette\Database\SqlLiteral("rgt - 2")));
			$this->database->table("shop_category")->select("*")->where("id", $category_id)->delete();
			return true;
		}
		else
			return false;
	}
}

