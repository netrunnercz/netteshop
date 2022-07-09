<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.42527000 1454416387";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\detail.latte";i:2;i:1454401578;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\detail.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'xi6l0av1du')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block h1
//
if (!function_exists($_l->blocks['h1'][] = '_lb99e633403b_h1')) { function _lb99e633403b_h1($_l, $_args) { extract($_args)
?>Detail objednávky <?php echo Nette\Templating\Helpers::escapeHtml($order->id, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb1525121281_content')) { function _lb1525121281_content($_l, $_args) { extract($_args)
?><div class="box floatleft w50">
	<div class="boxTitle">Zákazník</div>
	<div class="boxContent">
<?php if ($order->sms_address): ?>
				<?php echo Nette\Templating\Helpers::escapeHtml($order->sms_address, ENT_NOQUOTES) ?>

<?php else: ?>
			<?php echo Nette\Templating\Helpers::escapeHtml($order->customer_firstname, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($order->customer_lastname, ENT_NOQUOTES) ?><br />
			<?php echo Nette\Templating\Helpers::escapeHtml($order->customer_street, ENT_NOQUOTES) ?><br />
			<?php echo Nette\Templating\Helpers::escapeHtml($order->customer_zip, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($order->customer_city, ENT_NOQUOTES) ?>

<?php endif ?>
		<br /><br />

		<?php echo Nette\Templating\Helpers::escapeHtml($template->phone($order->customer_phone), ENT_NOQUOTES) ?><br />
		<?php echo Nette\Templating\Helpers::escapeHtml($order->customer_email, ENT_NOQUOTES) ?>

	</div>
</div>

<div class="box floatright w50">
	<div class="boxTitle">Informace</div>
	<div class="boxContent">
		Datum objednání: <?php echo Nette\Templating\Helpers::escapeHtml($template->date($order->ordered, 'j. n. Y'), ENT_NOQUOTES) ?><br />
		Zaplaceno: <?php if ($order->paid): echo Nette\Templating\Helpers::escapeHtml($template->date($order->paid, 'j. n. Y'), ENT_NOQUOTES) ;else: ?>
ne<?php endif ?><br />
		Způsob platby: <?php echo Nette\Templating\Helpers::escapeHtml($order->payment, ENT_NOQUOTES) ?><br />
		state: <?php echo Nette\Templating\Helpers::escapeHtml($order->status, ENT_NOQUOTES) ?><br />
	</div>
</div>

<div class="box floatright w50">
	<div class="boxTitle">Odeslat upozornění</div>
	<div class="boxContent">
		<a href="<?php echo htmlSpecialChars($_control->link("sendNotification!", array($order->id))) ?>">Odeslat</a>
	</div>
</div>

<table class="grid clear">
	<thead>
		<tr>
			<td></td>
			<td>Zboží</td>
			<td class="center">Kusů</td>
			<td class="right">Cena/ks</td>
			<td class="right">Cena</td>
		</tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($items as $item): ?>
		<tr>
			<td width="1" class="center"><img src="/i/small/<?php echo htmlSpecialChars($item->pid) ?>
-<?php echo htmlSpecialChars($item->mainImage) ?>.jpg" alt="<?php echo htmlSpecialChars($item->name) ?>
" title="<?php echo htmlSpecialChars($item->name) ?>" class="micro" /></td>
			<td><a href="<?php echo htmlSpecialChars($_control->link("Product:edit", array('product_id' => $item->pid))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($item->name, ENT_NOQUOTES) ?></a></td>
			<td class="center"><?php echo Nette\Templating\Helpers::escapeHtml($item->quantity, ENT_NOQUOTES) ?></td>
			<td class="right"><?php echo Nette\Templating\Helpers::escapeHtml($template->price($item->price_czk), ENT_NOQUOTES) ?>&nbsp;Kč</td>
			<td class="right"><?php echo Nette\Templating\Helpers::escapeHtml($template->price($item->price_czk*$item->quantity), ENT_NOQUOTES) ?>&nbsp;Kč</td>
		</tr>
<?php $iterations++; endforeach ?>
		<tr>
			<td colspan="4" class="right">Celkem za zboží</td>
			<td class="right highlight"><?php echo Nette\Templating\Helpers::escapeHtml($template->price($order->total - $order->postage), ENT_NOQUOTES) ?>&nbsp;Kč</td>
		</tr>
		<tr>
			<td colspan="4" class="right">Poštovné</td>
			<td class="right highlight"><?php echo Nette\Templating\Helpers::escapeHtml($template->price($order->postage), ENT_NOQUOTES) ?>&nbsp;Kč</td>
		</tr>
		<tr>
			<td colspan="4" class="right strong highlight">Celkem</td>
			<td class="right strong highlight"><?php echo Nette\Templating\Helpers::escapeHtml($template->price($order->total), ENT_NOQUOTES) ?>&nbsp;Kč</td>
		</tr>
	</tbody>
</table>
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
call_user_func(reset($_l->blocks['h1']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 