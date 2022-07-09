<?php

abstract class BaseModel extends Nette\Object {
	protected $database;
	
	public function __construct(Nette\Database\Connection $connection) {
		$this->database = $connection;
	}
}

