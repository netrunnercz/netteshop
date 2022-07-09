<?php

namespace AdminModule;

use \Nette\Application\UI\Form;

class OrderPresenter extends SecuredPresenter {
	
	private $orderList = array(),
					$paidUnshippedList = array(),
					$payOnDeliveryShippedList = array(),
					$payOnDeliveryUnshippedList = array();

	protected function startup() {
		parent::startup();
	}
	
	protected function createComponentPaginator() {
		$visualPaginator = new \VisualPaginator();
		$visualPaginator->paginator->itemsPerPage = 30;
		return $visualPaginator;
	}
	
	protected function createFormList($list) {
		$form = new Form;
		
		$c = $form->addContainer("order");
		foreach($list as $order)
			$c->addCheckbox($order["id"]);
		
		$actions = array(
				0 => "--vyber--",
				1 => "Označit jako zaplacené",
				2 => "Označit jako odeslané",
				3 => "Vytisknout stvrzenky"
			);
		$form->addSelect("action", "Vybrané objednávky:", $actions);
		
		$form->addSubmit("submit");
		
		$form->onSuccess[] = callback($this, 'formListSubmitted');
		
		return $form;
	}

	public function createComponentFormList() {
		return $this->createFormList($this->orderList);
	}
		
	public function createComponentFormPaidUnshippedList() {
		return $this->createFormList($this->paidUnshippedList);
	}
	
	public function createComponentFormPayOnDeliveryShippedList() {
		return $this->createFormList($this->payOnDeliveryShippedList);
	}
	
	public function createComponentFormPayOnDeliveryUnshippedList() {
		return $this->createFormList($this->payOnDeliveryUnshippedList);
	}
	
	public function formListSubmitted(Form $form) {
		$values = $form->getValues();
		
		$ids = array_keys($form->getComponent("order")->getValues(true), true);
		
		$order = new \Order($this->context->database);
		switch($form["action"]->getValue()) {
		case 1: 
			$order->setPaid($ids);
			break;

		case 2:
			$order->setShipped($ids);
			break;
		
		case 3:
			$this->redirect("Invoice:", implode(",", $ids));
			break;
		
		default:
			break;
		}
		
		$this->redirect('this');
	}
	
	public function handleMarkPaid($order_id) {
		$order = new \Order($this->context->database);
		$order->setPaid($order_id);
		$this->redirect('this');
	}
	
	public function handleMarkShipped($order_id) {
		$order = new \Order($this->context->database);
		$order->setShipped($order_id);
		$this->redirect('this');
	}
	
	public function handleSendNotification($order_id) {
		$order = new \Order($this->context->database);
		
		$mailTemplate = $this->createTemplate();
		$mailTemplate->setFile(__DIR__."/../templates/Mails/notificationMail.latte");
		$information = $order->getInformation($order_id);

		$mailTemplate->number = $information->id;
		$mailTemplate->payment = $information->payment;
		$mailTemplate->total = $information->total;
		$mailTemplate->items = $order->getItems($order_id);
		$mailTemplate->postage = $information->postage;

		$mail = new \Nette\Mail\Message;
		$mail->setFrom("E-shop Koně & hříbata <shop@koneahribata.cz>")
						->addTo($information->customer_email)
						->setSubject("Informace o objednávce")
						->setHtmlBody($mailTemplate)
						->send();
		
		$this->flashMessage("E-mail odeslán.");
		
		$this->redirect('this');
	}
	
	public function actionDefault() {
		$orders = new \Order($this->context->database);
		
		$paginator = $this['paginator']->getPaginator();
		
		$this->orderList = $orders->getList($paginator->itemsPerPage, $paginator->offset);
		$this->paidUnshippedList = $orders->getPaidUnshipped();
		$this->payOnDeliveryUnshippedList = $orders->getPayOnDelivery();
		$this->payOnDeliveryShippedList = $orders->getPayOnDelivery(true);
	}

	public function renderDefault() {
		$orders = new \Order($this->context->database);
		
		$paginator = $this['paginator']->getPaginator();
		
		$this->template->ordersPaidUnshipped = $orders->getPaidUnshipped();
		
		$this->template->ordersPayOnDeliveryUnshipped = $orders->getPayOnDelivery();
		
		$this->template->ordersPayOnDeliveryShipped = $orders->getPayOnDelivery(true);
		
		$this->template->orders = $this->orderList;//$orders->getList($paginator->itemsPerPage, $paginator->offset);
		
		$paginator->itemCount = $orders->getCountByStatus();
	}

	public function renderDetail($id) {
		$order = new \Order($this->context->database);
		
		$this->template->order = $order->getInformation($id);
		
		$this->template->items = $order->getItems($id);
	}
}