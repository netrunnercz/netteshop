<?php //netteCache[01]000396a:2:{s:4:"time";s:21:"0.71284600 1454416373";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:74:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\default.latte";i:2;i:1454401578;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'a3b8uqcmom')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block h1
//
if (!function_exists($_l->blocks['h1'][] = '_lb7e0318d055_h1')) { function _lb7e0318d055_h1($_l, $_args) { extract($_args)
?>Objednávky<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb98ade3bf42_content')) { function _lb98ade3bf42_content($_l, $_args) { extract($_args)
?><h2>Nově zaplacené objednávky</h2>
<?php Nette\Latte\Macros\CoreMacros::includeTemplate("orderList.latte", array('formName' => "formPaidUnshippedList", 'orders' => $ordersPaidUnshipped) + $template->getParameters(), $_l->templates['a3b8uqcmom'])->render() ?>

<h2>Nové dobírky</h2>
<?php Nette\Latte\Macros\CoreMacros::includeTemplate("orderList.latte", array('formName' => "formPayOnDeliveryUnshippedList", 'orders' => $ordersPayOnDeliveryUnshipped) + $template->getParameters(), $_l->templates['a3b8uqcmom'])->render() ?>

<h2>Odeslané nezaplacené dobírky</h2>
<?php Nette\Latte\Macros\CoreMacros::includeTemplate("orderList.latte", array('formName' => "formPayOnDeliveryShippedList", 'orders' => $ordersPayOnDeliveryShipped) + $template->getParameters(), $_l->templates['a3b8uqcmom'])->render() ?>

<h2>Všechny objednávky</h2>
<?php $_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;Nette\Latte\Macros\CoreMacros::includeTemplate("orderList.latte", array('formName' => "formList", 'orders' => $orders) + $template->getParameters(), $_l->templates['a3b8uqcmom'])->render() ;$_ctrl = $_control->getComponent("paginator"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['h1']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 