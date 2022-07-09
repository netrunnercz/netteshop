<?php

namespace AdminModule;

use Nette\Application\UI,
	Nette\Security as NS;

class SignPresenter extends BasePresenter {
	
	protected function startup() {
		parent::startup();
	}

	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		$form->addText('username');

		$form->addPassword('password');

		$form->addSubmit('send', 'Přihlásit');

		$form->onSuccess[] = callback($this, 'signInFormSubmitted');
		return $form;
	}

	public function signInFormSubmitted($form)
	{
		try {
			$values = $form->getValues();
			$this->getUser()->setExpiration('+ '. $this->config->loginLifetimeAdmin .' hours', TRUE);

			$this->getUser()->login($values->username, $values->password);
			$this->flashMessage("Přihlášení proběhlo úspěšně.");
			$this->redirect('Homepage:');

		} catch (NS\AuthenticationException $e) {
			$form->addError("Neplatné přihlášení.");
		}
	}

	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odlášení proběhlo v pořádku.');
		$this->redirect('in');
	}

}