<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.80279400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\wwwroot\koneahribata\shop\app\FrontModule\components\MenuControl.latte";i:2;i:1454401581;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\components\MenuControl.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'wm6wl8kcft')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$currDepth = 0 ;while ((!empty($tree))): $currNode = array_shift($tree) ;if ($currNode['depth'] == 0 || strpos($currNode['path'], $current) !== false): if ($currNode['depth'] > $currDepth): ?>
			<ul class="submenu">
<?php endif ;if (($currNode['depth'] < $currDepth)): for ($i = 1; $i <= $currDepth - $currNode['depth']; $i++): ?>
			</ul>
<?php endfor ;endif ?>
		<li class="category"><a href="<?php echo htmlSpecialChars($_presenter->link("Category:", array('id' => $currNode['path']))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($currNode['name'], ENT_NOQUOTES) ?></a></li>
<?php $currDepth = $currNode['depth'] ;if ((empty($tree))): for ($i = 1; $i <= $currDepth + 1; $i++): ?>
				</ul>
<?php endfor ;endif ;endif ;endwhile ;