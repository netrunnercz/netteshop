<?php

namespace AdminModule;

use \Nette\Application\UI\Form;

class ArticlePresenter extends SecuredPresenter {
	
	public function startup() {
		parent::startup();
	}
	
	public function createComponentFormEdit() {
		$form = new Form;
		
		$form->addText("name", "Název:");
		
		$form->addTextArea("text");
		
		$form->addHidden("id");
		
		$form->addSubmit('ok', 'Send');
		
		$form->onSuccess[] = array($this, "formEditSubmitted");
		
		return $form;
	}
	
	public function formEditSubmitted(Form $form) {
		$article = new \Article($this->context->database);
		$values = $form->getValues();
		if(!empty($values["id"]))
			$article->edit($values["id"], $values);
		else {
			unset($values["id"]);
			$article->create($values);
		}
		
		$this->redirect('this');
	}


	public function renderDefault() {
		$this->template->articles = $this->context->database->table("shop_article")->select("id, name")->order("id");
	}
	
	public function actionEdit($id) {
		if(isset($id)) {
			$article = new \Article($this->context->database);
			$this["formEdit"]->setDefaults($article->findById($id));
		}
	}
	
	public function renderEdit($id) {

	}
}