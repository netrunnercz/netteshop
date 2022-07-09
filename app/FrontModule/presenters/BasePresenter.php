<?php

namespace FrontModule;

abstract class BasePresenter extends \Nette\Application\UI\Presenter {
	
	protected $cart;
	protected $config;

	protected function startup() {
		parent::startup();
		
		$this->config = $this->context->config;
	}
	
	protected function createComponentCart() {
		return new CartControl();
	}
	
	protected function createComponentMenu() {
		return new MenuControl();
	}
	
	protected function createComponentBreadcrumbs($name) {
		$breadcrumbs = new BreadcrumbsControl($this, $name);
		$breadcrumbs->addCrumb("Domů", $this->link('Homepage:'));
		
		return $breadcrumbs;
	}
	
	public function createComponentSearchForm() {
		$form = new \Nette\Application\UI\Form();
		
		$form->addText("q");
		
		$form->addImage("send", "/images/search.png");
		
		$form->onSuccess[] = callback($this, "formSearchSubmitted");
		
		return $form;
	}
	
	public function formSearchSubmitted($form) {
		$values = $form->getValues();
		$this->redirect("Search:", $values["q"]);
	}
	
	public function beforeRender() {
		$categories = new \Category($this->context->database);
		$this->template->categories = $categories->listAll("id", "ASC", 0);
		
		
		$this->template->cartquantity = $this->context->cart->getTotalquantity();
		$this->template->cartPrice = $this->context->cart->getTotalPrice();
	}
	
	public function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		$texy = new \Texy;
		$texy->headingModule->balancing = \TexyHeadingModule::FIXED;
		$texy->mergeLines = false;
		$texy->setOutputMode(\Texy::HTML5);
		$template->registerHelper("texy", array($texy, "process"));
		
		$template->registerHelper("price", function($s, $dec_point = ",", $thousands_sep = " "){
			if($s - (int)$s)
				return number_format($s, 2, $dec_point, $thousands_sep);
			else
				return number_format($s, 0, $dec_point, $thousands_sep);
		});
		
		return $template;
	}
					
}
