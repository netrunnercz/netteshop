<?php

namespace FrontModule;

use \Nette\Application\UI\Form;

class BreadcrumbsControl extends \Nette\Application\UI\Control {
	
	private $route = array();
	
	public function __construct() {
		parent::__construct();
	}
	
	public function setHome($name, $link) {
		$this->route[0] = array("name" => $name, "link" => $link);
	}
	
	public function addCrumb($name, $link) {
		$this->route[] = array("name" => $name, "link" => $link);
	}
	
	public function render() {
		$this->template->setFile(__DIR__."/BreadcrumbsControl.latte");
		$this->template->route = $this->route;
		
		$this->template->render();
	}
}
