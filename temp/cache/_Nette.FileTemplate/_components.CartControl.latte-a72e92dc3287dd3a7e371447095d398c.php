<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.81839400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\wwwroot\koneahribata\shop\app\FrontModule\components\CartControl.latte";i:2;i:1454401580;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\components\CartControl.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'x7zs0sivx6')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["add-$id"], array()) ?>
	<?php echo $_form["id"]->getControl()->addAttributes(array()) ?>

	<?php echo $_form["quantity"]->getControl()->addAttributes(array('class' => 'quantity')) ?>

	<?php echo $_form["send"]->getControl()->addAttributes(array('class' => 'toCartButton', 'value' => "")) ?>

<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;