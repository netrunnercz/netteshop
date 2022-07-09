<?php //netteCache[01]000390a:2:{s:4:"time";s:21:"0.85622300 1454407085";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:68:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Sign\in.latte";i:2;i:1454401579;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Sign\in.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 's010ezeoz1')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb24a197edb9_content')) { function _lb24a197edb9_content($_l, $_args) { extract($_args)
?><div class="login">
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["signInForm"], array()) ?>
		<table>
			<tr>
				<td rowspan="5"><img src="/images/key.png" /></td>
				<td class="label center">Uživatel:</td>
			</tr>
			<tr>
				<td><?php echo $_form["username"]->getControl()->addAttributes(array()) ?></td>
			</tr>
			<tr>
				<td class="label center">Heslo:</td>
			</tr>
			<tr>
				<td><?php echo $_form["password"]->getControl()->addAttributes(array()) ?></td>
			</tr>
			<tr>
				<td class="center"><?php echo $_form["send"]->getControl()->addAttributes(array()) ?></td>
			</tr>
		</table>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
</div><?php
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
$robots = 'noindex' ?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 