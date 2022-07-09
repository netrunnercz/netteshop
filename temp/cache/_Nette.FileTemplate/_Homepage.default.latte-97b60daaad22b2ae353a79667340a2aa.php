<?php //netteCache[01]000399a:2:{s:4:"time";s:21:"0.75599400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:77:"C:\wwwroot\koneahribata\shop\app\FrontModule\templates\Homepage\default.latte";i:2;i:1454401584;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\templates\Homepage\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'd276rl84i6')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb96b64cd56_content')) { function _lbb96b64cd56_content($_l, $_args) { extract($_args)
?>	<a class="current-issue" href="<?php echo htmlSpecialChars($_control->link("Product:default", array($currentIssue->id))) ?>
"><div id="current-issue">
		<img src="<?php if ($currentIssue->mainImage): ?>/i/medium/<?php echo htmlSpecialChars($currentIssue->id) ?>
-<?php echo htmlSpecialChars($currentIssue->mainImage) ?>.jpg<?php else: ?>/i/noimage-medium.jpg<?php endif ?>
" alt="<?php echo htmlSpecialChars($currentIssue->name) ?>" title="<?php echo htmlSpecialChars($currentIssue->name) ?>" />
		<h3>Aktuální číslo časopisu Koně &amp hříbata<br />
		<?php echo Nette\Templating\Helpers::escapeHtml($currentIssue->name, ENT_NOQUOTES) ?></h3>
		<?php echo $template->texy($currentIssue->description) ?>

	</div></a>

<h2>Novinky v nabídce</h2>

<?php Nette\Latte\Macros\CoreMacros::includeTemplate('../productBox.latte', $template->getParameters(), $_l->templates['d276rl84i6'])->render() ?>

<?php
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 