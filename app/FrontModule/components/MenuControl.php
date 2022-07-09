<?php

namespace FrontModule;

class MenuControl extends \Nette\Application\UI\Control {
	
	private $current;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function setCurrent($current) {
		$explode = explode("/", $current);
		unset($explode[count($explode) - 1]);
		
		if(count($explode))
			$this->current = implode("/", $explode);
		else
			$this->current = $current;
	}
	
	public function render() {
		$this->template->setFile(__DIR__."/MenuControl.latte");
		
		$this->template->current = $this->current;
		
		$category = new \Category($this->presenter->context->database);
		$this->template->tree = $category->getTree();
		
		$this->template->render();
	}
}
