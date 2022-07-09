<?php

namespace AdminModule;

use Nette\Application\UI\Form,
		Nette\Application\UI\MyForm;

class ProductPresenter extends SecuredPresenter {
	
	/** @persistent */
	public $category_id;
	
	/** @persistent */
	public $product_id;

	protected function startup() {
		parent::startup();
	}
	
	public function createComponentFormCategory() {
		$form = new Form;
		
		$categories = new \Category($this->context->database);
		$list = $categories->getTree("--");
		$items = array();
		foreach($list as $c) {
			$items[$c["id"]] = $c["intendedName"];
		}
		$form->addSelect("category_id", "Omezit kategorie", $items)->setDefaultValue($this->category_id);
		$form->setMethod("GET");
		$form->addSubmit("send", "Filtrovat");
		
		$form->onSuccess[] = array($this, "formCategorySubmitted");
		
		return $form;
	}
	
	public function formCategorySubmitted(Form $form) {
		$this->category_id = $form->getValues()->category_id;
		$this->redirect("this");
	}
	
	public function actionDefault() {
		$this->product_id = NULL;
	}

	public function renderDefault($category_id = NULL) {
		$products = new \Product($this->context->database);
		$this->template->products = $products->findByCategory($category_id, false, "id", "desc", NULL, NULL, true);
	}
	
	public function createComponentFormEdit() {
		$product = new \Product($this->context->database);
		$data = $product->findById($this->product_id);
		
		$form = new Form;
		
		$form->addText("name", "Název")
						->setDefaultValue($data["name"]);
		$form->addTextArea("description", "Popis")
						->setDefaultValue($data["description"]);
		$form->addTextArea("description_long", "Dlouhý popis")
						->setDefaultValue($data["description_long"]);
		$form->addText("price_czk", "Cena Kč")
						->setDefaultValue($data["price_czk"]);
		$form->addText("vat_rate_id", "DPH id")
						->setDefaultValue($data["vat_rate_id"])
						->setOption("description", "0 % - 1; 14 % - 2; 20 % - 3");
		$form->addText("status", "Status")
						->setDefaultValue($data["status"])
						->setOption("description", "0/1");
		
		$categories = new \Category($this->context->database);
		$list = array();
		foreach($categories->getTree("--") as $row)
			$list[$row["id"]] = $row["intendedName"];
		$default = array();
		foreach($product->getCategories($this->product_id) as $single)
			$default[] = $single["id"];
		$form->addMultiSelect("category", "Kategorie", $list, 10)->setDefaultValue($default);
		
		$images = $product->getImages($this->product_id);
		$list = array();
		foreach($images as $image)
			$list[$image->id] = \Nette\Utils\Html::el("img")->src("/i/small/".$this->product_id."-".$image->id.".jpg");
		
		if(!empty($list))
			$form->addRadioList("mainImage", "Hlavní:", $list)->setDefaultValue($data["mainImage"]);
		
		$form->addSubmit("send", "Uložit produkt");
		
		$form->onSuccess[] = array($this, "formEditSubmitted");
		
		return $form;
	}
	
	public function formEditSubmitted(Form $form) {
		$product = new \Product($this->context->database);
		$values = $form->getValues();
		
		if(!empty($this->product_id))
			$product->edit($this->product_id, $values);
		else {
			$newid = $product->create($values);
			$this->product_id = $newid;
		}
		
		$this->flashMessage("Produkt byl upraven.");
		
		$this->redirect('this');
	}
	
	public function createComponentFormImage() {
		$form = new Form;
		
		$form->addMultiUpload("image", "Obrázek")->addCondition(Form::FILLED)->addRule(Form::IMAGE, "Lze vložit pouze obrázky");
		
		$form->addSubmit("send", "Nahrát obrázky");
		
		$form->onSuccess[] = array($this, "formImageSubmitted");
		
		return $form;
	}
	
	public function formImageSubmitted(Form $form) {
		if($this->product_id) {
			$product = new \Product($this->context->database);

			$values = $form->getValues();
			
			dump($values);
			foreach($values["image"] as $image)
				$product->addImage($this->product_id, $image->getTemporaryFile());

			$this->flashMessage("Obrázky byly vloženy.");

			$this->redirect("this");
		} else {
			$this->flashMessage("Nejdříve musíš založit produkt.");
			$this->redirect("this");
		}
	}
	
	public function renderEdit() {
		if($this->product_id) {
			$product = new \Product($this->context->database);
			$this->template->product = $product->findById($this->product_id);
			//$this["formEdit"]->setDefaults($product[0]);
		}
	}

}