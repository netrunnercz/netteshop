<?php

namespace FrontModule;

class HomepagePresenter extends BasePresenter
{
	
	protected function startup() {
		parent::startup();
	}

	public function renderDefault() {
		$product = new \Product($this->context->database);
		$currentIssue = $product->getCurrentIssue();//findByCategory(1, false, "id", "DESC", 1);

		$this->template->currentIssue = $currentIssue[0];
		
		//$newProducts = new \Product($this->context->database);
		$products = $product->findByCategory(NULL, false, "id", "DESC", $this->config->newProductsCount);
		$this->template->products = $products;
	}

}
