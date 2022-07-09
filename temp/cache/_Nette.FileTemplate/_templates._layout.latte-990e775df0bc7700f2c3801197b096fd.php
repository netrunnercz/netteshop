<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.77159400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\wwwroot\koneahribata\shop\app\FrontModule\templates\@layout.latte";i:2;i:1454401582;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'qe0kh9pi6l')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbf2bfbc88fb_content')) { function _lbf2bfbc88fb_content($_l, $_args) { extract($_args)
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
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php if (isset($title)): echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?>
 &ndash; <?php endif ?>Koně &amp; hříbata</title>
	<link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars($basePath) ?>/css/screen.css" />
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo htmlSpecialChars($basePath) ?>/js/shop.js"></script>
	</head>
	<body>
		<div id="page">
			<div id="head">
				<h1><a href="<?php echo htmlSpecialChars($_control->link("Homepage:")) ?>"><span>Home</span></a></h1>
				<div id="cart">
					<a href="<?php echo htmlSpecialChars($_control->link("Cart:")) ?>">
						<span class="cartContent">
<?php if (!empty($cartquantity)): ?>
								V košíku máte:<br />
								<?php echo Nette\Templating\Helpers::escapeHtml($cartquantity, ENT_NOQUOTES) ?>
&nbsp;ks zboží za <?php echo Nette\Templating\Helpers::escapeHtml($template->price($cartPrice), ENT_NOQUOTES) ?>&nbsp;Kč
<?php else: ?>
								Váš košík je prázdný.
<?php endif ?>
						</span>
					</a>
				</div>
				<div id="topmenu">
					<ul>
						<li><a href="<?php echo htmlSpecialChars($_control->link("Article:", array(3))) ?>
">Vše o nákupu</a></li>
						<li><a href="<?php echo htmlSpecialChars($_control->link("Article:", array(2))) ?>
">O nás</a></li>
						<li><a href="<?php echo htmlSpecialChars($_control->link("Article:", array(1))) ?>
">Kontakt</a></li>
					</ul>
				</div>
			</div>
			
			<div id="main">
				<div id="breadcrumbs">
<?php $_ctrl = $_control->getComponent("breadcrumbs"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
				</div>
				<div id="left-menu">
					<div class="left-menu-box">
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["searchForm"], array('class' => "search")) ?>
							<?php echo $_form["q"]->getControl()->addAttributes(array('class' => "q", 'placeholder' => "Hledat...")) ;echo $_form["send"]->getControl()->addAttributes(array('class' => "send")) ?>

<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
					</div>
					
					<ul class="menublock">
						<li class="header">Kategorie</li>
<?php $_ctrl = $_control->getComponent("menu"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
					</ul>
					
					<div class="left-menu-box" style="margin-top: 15px">
						<h2>Předplatné</h2>
						Hledáte předplatné časopisu Koně&nbsp;&amp;&nbsp;hříbata? Můžete si jej objednat přímo na <a href="http://www.koneahribata.cz/predplatne">stránkách časopisu</a>.
					</div>
				</div>

				<div id="content">
<?php $iterations = 0; foreach ($flashes as $flash): ?>					<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ;if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>
				</div>

				<div class="clear"></div>
			</div>
			
			<div id="footer">
				Všechny ceny jsou uvedeny včetně DPH v zákonné výši a jsou konečné. Žádná část tohoto webu nesmí být kopírována bez souhlasu provozovatele.
			</div>
		</div>
	</body>
</html>