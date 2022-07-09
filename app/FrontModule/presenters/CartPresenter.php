<?php

namespace FrontModule;

use \Nette\Application\UI\Form;

class CartPresenter extends BasePresenter {

	protected function startup() {
		parent::startup();
	}
	
	public function createComponentAlter($id) {
		$that = $this;
		return new \Nette\Application\UI\Multiplier(function ($id) use ($that) {
			$form = new Form();
		
			$form->addText("quantity")
							->addRule(Form::RANGE, "Do košíku lze vložit pouze kladný počet kusů.", array(1, null))
							->addRule(Form::INTEGER, "Do košíku lze vložit pouze celý počet kusů.")
							->setDefaultValue(1);
			$form->addHidden("id", $id);
			$form->addSubmit("send", "");
			
			$form->onSuccess[] = array($that, "alterSubmitted");

			return $form;
		});
	}
	
	public function alterSubmitted(Form $form) {
		$values = $form->getValues();
		$this->context->cart->alter($values["id"], $values["quantity"]);
		
		$this->redirect("this");
	}
	
	public function createComponentDelete($id) {
		$that = $this;
		return new \Nette\Application\UI\Multiplier(function ($id) use ($that) {
			$form = new Form();

			$form->addHidden("id", $id);
			$form->addSubmit("send", "");
			
			$form->onSuccess[] = array($that, "deleteSubmitted");

			return $form;
		});
	}
	
	public function deleteSubmitted(Form $form) {
		$values = $form->getValues();
		$this->context->cart->delete($values["id"]);
		
		$this->redirect("this");
	}

	public function actionDefault() {
		
	}

	public function renderDefault() {
		$cart = $this->context->cart->getCart();
		if(!empty($cart)) {
			$products = new \Product($this->context->database);
			//dump($products->findById(array_keys($this->context->cart->getCart()))); exit;
			$this->template->products = $products->findById(array_keys($this->context->cart->getCart()));
			$this->template->quantities = $this->context->cart->getCart();
			$this->template->total = $this->context->cart->getTotalPrice();
		}
	}
	
	public function actionClean() {
		$this->context->cart->clean();
		$this->redirect('default');
	}

}