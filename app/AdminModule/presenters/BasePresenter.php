<?php

namespace AdminModule;

abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	protected $config;
	/**
	 * (non-phpDoc)
	 *
	 * @see Nette\Application\Presenter#startup()
	 */
	protected function startup() {
		parent::startup();
		
		\Nette\Application\UI\Form::extensionMethod('addMultiUpload', function(\Nette\Application\UI\Form $form, $name, $label = NULL) {
			$form[$name] = new \Nette\Forms\Controls\MultiUploadControl($label);
			return $form[$name];
		});
		
		$authenticator = new \Nette\Security\SimpleAuthenticator(array('admin' => 'kl1ok2an'));
		$this->user->setAuthenticator($authenticator);
		
		$this->config = $this->context->config;
	}
	
	public function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		$texy = new \Texy;
		$texy->headingModule->balancing = \TexyHeadingModule::FIXED;
		$texy->mergeLines = false;
		$texy->setOutputMode(\Texy::HTML5);
		$template->registerHelper("texy", array($texy, "process"));
		
		$template->registerHelper("price", function($s, $dec_point = ",", $thousands_sep = " "){
			if($s - (int)$s)
				return number_format($s, 2, $dec_point, $thousands_sep);
			else
				return number_format($s, 0, $dec_point, $thousands_sep);
		});
		
		$template->registerHelper("phone", function($string){
			preg_match('~^(\d{3}) ?(\d{3}) ?(\d{3}) ?(.*)$~ui', strrev($string), $match);
			return strrev($match[4])." ".strrev($match[3])." ".strrev($match[2])." ".strrev($match[1]);
		});
		
		return $template;
	}

}