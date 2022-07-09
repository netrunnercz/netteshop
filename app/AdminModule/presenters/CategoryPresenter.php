<?php

namespace AdminModule;

use \Nette\Application\UI\Form;

class CategoryPresenter extends SecuredPresenter {
	/** @persistent */
	public $category_id;
	
	protected function startup() {
		parent::startup();
	}

	public function actionDefault() {
		$this->category_id = NULL;
	}

	public function renderDefault() {
		$categories = new \Category($this->context->database);
		
		$this->template->tree = $categories->getTree();
	}
	
	public function createComponentFormEdit() {
		$form = new Form;
		
		$form->addText("name", "Název:");
		
		$form->addText("nicename", "Nicename:");
		
		$categories = new \Category($this->context->database);
		$list[0] = "--žádná--";
		foreach($categories->getTree("--") as $row)
			$list[$row["id"]] = $row["intendedName"];
		$form->addSelect("parent", "Nadřazená", $list);
		
		$form->addSubmit('ok', 'Send');
		
		$form->onSuccess[] = array($this, "formEditSubmitted");
		
		return $form;
	}
	
	public function formEditSubmitted(Form $form) {
		$category = new \Category($this->context->database);
		$values = $form->getValues();
		dump($values);
		if(!empty($this->category_id))
			$category->edit($this->category_id, $values);
		else {
			$newid = $category->create($values);
			$this->category_id = $newid;
		}
		$this->flashMessage("Kategorie upravena.");
		$this->redirect('this');
	}
	
	public function actionEdit() {
		if(isset($this->category_id)) {
			$category = new \Category($this->context->database);
			$this["formEdit"]->setDefaults($category->findById($this->category_id));
		}
	}
	
	public function actionDelete($id) {
		$category = new \Category($this->context->database);
		if($category->delete($id))
			$this->flashMessage("Kategorie byla smazána.");
		else
			$this->flashMessage("Kategorii se nepodařilo smazat.", "error");
		
		$this->redirect("Category:");
	}

}