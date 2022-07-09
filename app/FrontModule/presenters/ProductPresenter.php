<?php

namespace FrontModule;

class ProductPresenter extends BasePresenter {

	protected function startup() {
		parent::startup();
	}

	public function actionDefault($id) {
		/*$product = new \Product($this->context->database);
		$product = $product->findById($id);
		
		$this->template->product = $product;*/
	}

	public function renderDefault($id) {
		$productModel = new \Product($this->context->database);
		$product = $productModel->findById($id);
		
		foreach($productModel->getCategories($id) as $category)
			$this["breadcrumbs"]->addCrumb($category->name, $this->link('Category:', $category->path));
		
		$this["menu"]->setCurrent($category->path);
		
		$this["breadcrumbs"]->addCrumb($product->name, $this->link('Product:', $product->id));
		
		$this->template->product = $product;
	}

}