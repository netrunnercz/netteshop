<?php

namespace FrontModule;

use \Nette\Application\UI\Form;


class OrderPresenter extends BasePresenter {
	
	public function startup() {
		parent::startup();
	}
	
	public function actionDefault() {

	}

	public function renderDefault() {

	}
	
	protected function createComponentFormPayment($name) {
		$form = new Form($this, $name);

		$form->addGroup('Dodací údaje');

		$form->addText('firstname', 'Jméno:')
				->addRule(Form::FILLED, 'Vyplňte prosím jméno.');
		$form->addText('lastname', 'Příjmení:')
				->addRule(Form::FILLED, 'Vyplňte prosím příjmení.');
		$form->addText('street', 'Ulice a číslo:')
				->addRule(Form::FILLED, 'Vyplňte prosím ulici a číslo domu.');
		$form->addText('city', 'Obec:')
				->addRule(Form::FILLED, 'Vyplňte prosím obec.');
		$form->addText('zip', 'PSČ:')
				->addRule(Form::FILLED, 'Vyplňte prosím PSČ.');
		$form->addSelect('country', 'Stát:', array('cz' => 'Česká republika', 'sk' => 'Slovensko'));
		
		$form->addText('email', 'E-mail:')
				->addRule(Form::EMAIL, 'Vyplňte prosím správně e-mail');
		$form->addText('phone', 'Telefon:');

		$form->addGroup('Doprava a platba');
		
		$form->addRadioList('payment', 'Způsob platby', array('prevod' => 'Česká pošta, převodem 65 Kč', 'slovensko' => 'Slovenská pošta, převodem 8 €'))
				->addRule(Form::FILLED, 'Vyberte prosím variantu dodání.');

		$form->addGroup();
		$form->addCheckbox('agreement')->addRule(Form::FILLED, 'K objednání je nutný souhlas s obchodními podmínkami.');
		$form->addSubmit('ok', 'Send');
		
		$form->onSuccess[] = array($this, 'formPaymentSubmitted');
		$form->renderer->wrappers['form']['errors'] = FALSE;
		$form->renderer->wrappers['control']['errors'] = TRUE;
		return $form;
	}

	public function formPaymentSubmitted(Form $form) {
		$values = $form->getValues();
		if(($values["country"] == "cz" && ($values["payment"] == "prevod" || $values["payment"] == "dobirka")) || ($values["country"] == "sk" && $values["payment"] == "slovensko")) {
			$order = new \Order($this->context->database);
			
			$id  = $order->create($values["firstname"], $values["lastname"], $values["street"], $values["city"], $values["zip"], $values["country"], $values["email"], $values["phone"]);
			
			$order->setPayment($id, $values["payment"]);
			
			//$cart = $this->context->cart->getCart();
			
			$order->insertItems($id, $this->context->cart->getCart());
			
			if($values["country"] == "cz") {
				if($this->context->cart->getTotalPrice() >= $this->config->freeShippingPurchase)
					$postage = 1;
				else {
					if($values["payment"] == 'dobirka')
						$postage = 4;
					else
						$postage = 2;
				}
			}
			else {
				$postage = 3;
			}
			
			$order->setPostage($id, $postage);
			
			
			$mailTemplate = $this->createTemplate();
			$mailTemplate->setFile(__DIR__."/../templates/Mails/orderMail.latte");
			$information = $order->getInformation($id);
			
			$mailTemplate->number = $information->id;
			$mailTemplate->payment = $information->payment;
			$mailTemplate->total = $information->total;
			$mailTemplate->items = $order->getItems($id);
			$mailTemplate->postage = $information->postage;
			
			$mail = new \Nette\Mail\Message;
			$mail->setFrom("E-shop Koně & hříbata <shop@koneahribata.cz>")
							->addTo($information->customer_email)
							->setSubject("Potvrzení objednávky")
							->setHtmlBody($mailTemplate)
							->send();
			
			
			$this->context->cart->clean();
			
			$this->getSession('orderId')->orderId = $id;
			
			$this->redirect('summary');
		}
		else {
			$this->flashMessage('Vyberte spránou kombinaci státu a dopravy.');
			$this->redirect('payment');
		}
	}
	
	public function actionSummary() {
		
	}

	public function renderSummary() {
		$order = new \Order($this->context->database);
		$information = $order->getInformation($this->getSession("orderId")->orderId);
		
		$this->template->number = $information->id;
		$this->template->payment = $information->payment;
		$this->template->total = $information->total;
		$this->template->postage = $information->postage;
	}
     
}