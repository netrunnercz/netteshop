<?php

class Article extends BaseModel {
	private $table = "shop_article";
	
	public function __construct(Nette\Database\Connection $connection) {
		parent::__construct($connection);
	}
	
	public function findById($id = NULL) {
		if(is_null($id))
			return;
		
		$selection = $this->database->table($this->table)->where("id", $id)->fetch();
		
		return $selection;
	}
	
	public function edit($article_id, $data) {
		return $this->database->table($this->table)->where("id", $article_id)->update($data);
	}
	
	public function create($data) {
		$row = $this->database->table($this->table)->insert($data);
		
		return $row["id"];
	}
}
