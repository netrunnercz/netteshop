<?php //netteCache[01]000399a:2:{s:4:"time";s:21:"0.99592700 1454407144";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:77:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Homepage\default.latte";i:2;i:1454401577;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Homepage\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'dsf2f3mdj8')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block h1
//
if (!function_exists($_l->blocks['h1'][] = '_lb128f3d4693_h1')) { function _lb128f3d4693_h1($_l, $_args) { extract($_args)
?>Úvod<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9575de20be_content')) { function _lb9575de20be_content($_l, $_args) { extract($_args)
;
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