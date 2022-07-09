<?php

namespace FrontModule;

use \Nette\Application\UI\Form;

class CartControl extends \Nette\Application\UI\Control {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function createComponentAdd($id) {
		$that = $this;
		return new \Nette\Application\UI\Multiplier(function ($id) use ($that) {
			$form = new Form();
		
			$form->addText("quantity")
							->addRule(Form::RANGE, "Do košíku lze vložit pouze kladný počet kusů.", array(1, null))
							->addRule(Form::INTEGER, "Do košíku lze vložit pouze celý počet kusů.")
							->setDefaultValue(1);
			$form->addHidden("id", $id);
			$form->addSubmit("send", "Do košíku");
			//$form->setAction($that->presenter->link("Order:Add"));
			
			$form->onSuccess[] = array($that, "addSubmitted");

			return $form;
		});
	}
	
	public function addSubmitted(Form $form) {
		$values = $form->getValues();
		$this->presenter->context->cart->add($values["id"], $values["quantity"]);
		$product = new \Product($this->presenter->context->database);
		$product = $product->findById($values["id"]);
		
		$el = \Nette\Utils\Html::el('span', "Zboží ".$product[0]["name"]." bylo přidáno do košíku. \n");
		$el2 = \Nette\Utils\Html::el('a', 'Zobrazit košík')->href($this->presenter->link('Cart:'));
		$el->add(\Nette\Utils\Html::el('br'))->add($el2);
		$this->presenter->flashMessage($el);
		$this->redirect('this');
	}
	
	public function render($id) {
		$this->template->setFile(__DIR__."/CartControl.latte");
		$this->template->id = $id;
		
		$this->template->render();
	}
	
}
