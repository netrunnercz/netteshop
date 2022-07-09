<?php

namespace AdminModule;

class InvoicePresenter extends SecuredPresenter {

	/**
	 * (non-phpDoc)
	 *
	 * @see Nette\Application\Presenter#startup()
	 */
	protected function startup() {
		parent::startup();
	}

	public function renderDefault($ids) {
		$ids = explode(",", $ids);
		
		$order = new \Order($this->context->database);
		
		$this->template->orders = $order->getFullById($ids);
	}

}