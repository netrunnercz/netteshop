<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.94000300 1454416348";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Product\default.latte";i:2;i:1454401579;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Product\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '9fqktxwffn')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block h1
//
if (!function_exists($_l->blocks['h1'][] = '_lb6b50e0dfd3_h1')) { function _lb6b50e0dfd3_h1($_l, $_args) { extract($_args)
?>Zboží<?php
}}

//
// block toolbar
//
if (!function_exists($_l->blocks['toolbar'][] = '_lb500c2d03da_toolbar')) { function _lb500c2d03da_toolbar($_l, $_args) { extract($_args)
?><ul class="toolbar">
	<li><a class="new" href="<?php echo htmlSpecialChars($_control->link("edit")) ?>
">Přidat</a>
</ul>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9973b80693_content')) { function _lb9973b80693_content($_l, $_args) { extract($_args)
;$_ctrl = $_control->getComponent("formCategory"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>

<table class="grid">
	<thead>
		<tr>
			<td>Id</td>
			<td>Foto</td>
			<td>Název</td>
			<td>Cena</td>
			<td>Status</td>
		</tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($products as $product): ?>
		<tr>
			<td width="1"><a href="<?php echo htmlSpecialChars($_control->link("edit", array('product_id' => $product->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($product->id, ENT_NOQUOTES) ?></a></td>
			<td width="1"><img src="/i/small/<?php echo htmlSpecialChars($product->id) ?>
-<?php echo htmlSpecialChars($product->mainImage) ?>.jpg" class="micro" /></td>
			<td><?php echo Nette\Templating\Helpers::escapeHtml($product->name, ENT_NOQUOTES) ?></td>
			<td><?php echo Nette\Templating\Helpers::escapeHtml($template->price($product->price_czk), ENT_NOQUOTES) ?> Kč</td>
			<td><?php if ($product->status): ?><span style="color: #00CC00;">OK</span><?php else: ?>
<span style="color: #CC0000;">není v prodeji</span><?php endif ?></td>
		</tr>
<?php $iterations++; endforeach ?>
	</tbody>
</table><?php
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


<?php call_user_func(reset($_l->blocks['toolbar']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 