<?php

namespace FrontModule;

class SearchPresenter extends BasePresenter {

	/** @persistent */
	public $q;
	
	protected function startup() {
		parent::startup();
	}

	public function actionDefault($q) {
		
	}
	
	protected function createComponentPaginator() {
		$visualPaginator = new \VisualPaginator();
		$visualPaginator->paginator->itemsPerPage = $this->config->productsPerPage;
		return $visualPaginator;
	}

	public function renderDefault($q) {
		$this["breadcrumbs"]->addCrumb('Hledání "'.$q.'"', $this->link('Search:', $q));
		
		$this->template->q = $q;
		
		$paginator = $this['paginator']->getPaginator();
		
		$product = new \Product($this->context->database);
		
		$products = $product->findByKeyword($q, false, $paginator->itemsPerPage, $paginator->offset);
		$this->template->products = $products;
		
		$paginator->itemCount = $product->findByKeyword($q, true);
		
	}

}