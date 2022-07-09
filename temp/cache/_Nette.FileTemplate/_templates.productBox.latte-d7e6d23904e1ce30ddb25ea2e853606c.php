<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.81839400 1454403147";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:71:"C:\wwwroot\koneahribata\shop\app\FrontModule\templates\productBox.latte";i:2;i:1454401582;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\FrontModule\templates\productBox.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'fkf3t3y9px')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($products) as $product): ?>
	<div class="category-productBox<?php if ((BCMod($iterator->getCounter() - 2, 3) == 0)): ?>
 middle<?php endif ?>">
		<a href="<?php echo htmlSpecialChars($_control->link("Product:default", array($product->id))) ?>
">
			<?php echo Nette\Templating\Helpers::escapeHtml($product->name, ENT_NOQUOTES) ?>

			<div class="category-productBoxImage">
				<img src="<?php if ($product->mainImage): ?>/i/medium/<?php echo htmlSpecialChars($product->id) ?>
-<?php echo htmlSpecialChars($product->mainImage) ?>.jpg<?php else: ?>/i/noimage-medium.jpg<?php endif ?>" />
			</div>
			</a>
		<div class="category-productBoxPrice">
			<?php echo Nette\Templating\Helpers::escapeHtml($template->price($product->price_czk), ENT_NOQUOTES) ?>&nbsp;Kč&nbsp;
<?php $_ctrl = $_control->getComponent("cart"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render($product->id) ?>
		</div>
	</div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;