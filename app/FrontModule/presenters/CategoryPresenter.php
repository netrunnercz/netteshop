<?php

namespace FrontModule;


class CategoryPresenter extends BasePresenter {

	protected function startup() {
		parent::startup();
	}
	
	protected function createComponentPaginator() {
		$visualPaginator = new \VisualPaginator();
		$visualPaginator->paginator->itemsPerPage = $this->config->productsPerPage;
		return $visualPaginator;
	}

	public function renderDefault($id) {
		$category = new \Category($this->context->database);
		$thisCategory = $category->findByPath($id);
		
		$this["menu"]->setCurrent($id);
		
		$line = $category->getLineByPath($id);
		foreach($line as $node) {
			$this["breadcrumbs"]->addCrumb($node->name, $this->link('Category:', $node->path));
		}

		$this->template->thiscategory = $thisCategory;
		
		$this->template->products = array();
		
		$paginator = $this['paginator']->getPaginator();
		
		$products = new \Product($this->context->database);
		
		$this->template->products = $products->findByCategory($thisCategory->id, false, "id" , "DESC", $paginator->itemsPerPage, $paginator->offset);
		
		$paginator->itemCount = $products->findByCategory($thisCategory->id, true);
	}

	public function actionDefault($id) {
		
	}

}