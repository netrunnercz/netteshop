<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.01152700 1454407145";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\@layout.latte";i:2;i:1454401576;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'lpju2bd8yw')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
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
	<title><?php if (isset($title)): echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?>
 &ndash; <?php endif ?>Koně &amp; hříbata</title>
	<link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/adminmain.css" />
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
	</head>
	<body>
	
		<div id="header">
			<span>E-shop Koně &amp; hříbata | Administrace</span>
			
			<div class="logout"><a href="<?php echo htmlSpecialChars($_control->link("Sign:out")) ?>
">Odhlásit</a></div>
		</div>
		
		<div id="menu">
			<ul>
				<li><a href="<?php echo htmlSpecialChars($_control->link("Order:")) ?>">Objednávky</a></li>
				<li><a href="<?php echo htmlSpecialChars($_control->link("Product:")) ?>">Zboží</a></li>
				<li><a href="<?php echo htmlSpecialChars($_control->link("Category:")) ?>">Kategorie</a></li>
				<li><a href="<?php echo htmlSpecialChars($_control->link("Article:")) ?>">Články</a></li>
			</ul>
		</div>
		
		<div id="contentContainer">
<?php $iterations = 0; foreach ($flashes as $flash): ?>			<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
			
			
				<h1><?php if (isset($_l->blocks["h1"])): Nette\Latte\Macros\UIMacros::callBlock($_l, 'h1', $template->getParameters()) ;endif ?></h1>
				
				<?php if (isset($_l->blocks["toolbar"])): Nette\Latte\Macros\UIMacros::callBlock($_l, 'toolbar', $template->getParameters()) ;endif ?>

			
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
			</div>
		
	
	</body>
</html>