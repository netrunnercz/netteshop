<?php //netteCache[01]000402a:2:{s:4:"time";s:21:"0.78719400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:80:"C:\wwwroot\koneahribata\shop\app\FrontModule\components\BreadcrumbsControl.latte";i:2;i:1454401580;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\components\BreadcrumbsControl.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'z2ibwv7qq7')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($route) as $crumb): ?>
	<a href="<?php echo htmlSpecialChars($crumb['link']) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($crumb["name"], ENT_NOQUOTES) ?>
</a><?php if (!$iterator->isLast()): ?> > <?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;