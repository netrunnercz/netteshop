<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.87182300 1454407085";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Sign\@layout.latte";i:2;i:1454401579;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Sign\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'mq83tnn18m')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba3b24a2723_content')) { function _lba3b24a2723_content($_l, $_args) { extract($_args)
?>		
	</body>
</html><?php
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
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Přihlášení</title>
	<style>
		html, body {
			font-family: Tahoma, sans-serif;
			font-size: 14px;
			line-height: 130%;
			padding: 0;
			margin: 0;
			background-color: #333;
		}
		
		.login {
			margin-top: 50px;
		}
		
		.login table {
			margin: auto;
			border-radius: 10px;
			background-color: #EEE;
			padding: 10px;
			border: 2px solid #666;
		}
		
		.label {
			font-weight: bold;
		}
		
		.center {
			text-align: center;
		}
	</style>
	</head>
	<body>
	
<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 