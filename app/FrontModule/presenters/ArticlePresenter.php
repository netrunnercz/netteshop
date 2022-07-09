<?php

namespace FrontModule;

use \Nette\Application\UI\Form;

class ArticlePresenter extends BasePresenter {

	protected function startup() {
		parent::startup();
	}
	
	public function createComponentContactForm($name) {
		$form = new Form($this, $name);
		
		$form->addText("from", "Váš e-mail:")->addRule(Form::FILLED, "Abychom Vám mohli odpovědět, musíte zadat svůj e-mail.")->setDefaultValue("@");
		
		$form->addTextArea("text", "Text:")->addRule(Form::FILLED, "Opravdu bychom si rádi přečetli Váš vzkaz.");
		
		$form->addSubmit("send", "Odeslat");
		
		$form->getElementPrototype()->class = "contact";
		
		$form->onSuccess[] = callback($this, "contactFormSubmitted");
		
		return $form;
	}
	
	public function contactFormSubmitted(Form $form) {
		$values = $form->getValues();
		
		$mail = new \Nette\Mail\Message;
		$mail->setFrom($values["from"])
						->addTo("predplatne@koneahribata.cz")
						->setSubject("Kontaktní formulář")
						->setBody($values["text"])
						->send();
		
		$this->flashMessage("Vaše zpráva byla odeslána. Děkujeme.");
		
		$this->redirect('this');
	}

	public function actionDefault($id) {
		
	}

	public function renderDefault($id) {
		$article = new \Article($this->context->database);
		$data = $article->findById($id);
		$this->template->name = $data->name;
		
		$template = $this->createTemplate('\Nette\Templating\Template');
    $template->setSource($data->text);
    $this->template->text = $template->__toString();
	}

}