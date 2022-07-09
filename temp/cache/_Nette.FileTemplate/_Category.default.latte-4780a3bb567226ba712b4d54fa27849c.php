<?php //netteCache[01]000399a:2:{s:4:"time";s:21:"0.07891000 1454417093";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:77:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Category\default.latte";i:2;i:1454417082;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Category\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'u2lqoc4e8s')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb2e2bda77f1_content')) { function _lb2e2bda77f1_content($_l, $_args) { extract($_args)
?>
<a href="<?php echo htmlSpecialChars($_control->link("edit")) ?>">Nová</a>
<br />
<br />


<?php $currDepth = -1 ;while ((!empty($tree))): $currNode = array_shift($tree) ;if ($currNode['depth'] > $currDepth): ?>
    <ul>
<?php endif ;if (($currNode['depth'] < $currDepth)): for ($i = 1; $i <= $currDepth - $currNode['depth']; $i++): ?>
		</ul>
<?php endfor ;endif ?>
  <li><a href="<?php echo htmlSpecialChars($_control->link("edit", array('category_id' => $currNode['id']))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($currNode['name'], ENT_NOQUOTES) ?>
</a> (<a href="<?php echo htmlSpecialChars($_control->link("delete", array('id' => $currNode['id']))) ?>
">smazat</a>)</li>
<?php $currDepth = $currNode['depth'] ;if ((empty($tree))): for ($i = 1; $i <= $currDepth + 1; $i++): ?>
			</ul>
<?php endfor ;endif ;endwhile ;
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