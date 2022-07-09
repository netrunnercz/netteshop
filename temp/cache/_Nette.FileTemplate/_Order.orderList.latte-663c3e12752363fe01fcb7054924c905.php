<?php //netteCache[01]000398a:2:{s:4:"time";s:21:"0.72844600 1454416373";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:76:"C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\orderList.latte";i:2;i:1454401578;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"013c8ee released on 2012-02-03";}}}?><?php

// source file: C:\wwwroot\koneahribata\shop\app\AdminModule\templates\Order\orderList.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'r0lefpvy0w')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($orders): Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control[$formName], array()) ?>
		<table class="grid">
			<thead>
				<tr>
					<td style="width: 3em;">ID</td>
					<td>Jméno</td>
					<td>Adresa</td>
					<td style="width: 6em;">Status</td>
					<td style="width: 6em;">Platba</td>
					<td style="width: 6em;">Cena</td>
					<td style="width: 8em;">Zadáno</td>
					<td style="width: 8em;">Zaplaceno</td>
					<td style="width: 8em;">Expedováno</td>
					<td width="1"></td>
				</tr>
			</thead>
			<tbody>
<?php $iterations = 0; foreach ($orders as $order): ?>
					<tr style="background-color: #<?php echo htmlSpecialChars(Nette\Templating\Helpers::escapeCss($order->paid ? ($order->shipped ? "bfb" : "fbb") : ($order->shipped ? "ff3" : ($order->payment == "dobirka" ? "fbb" : "inhereit")))) ?>">
						<td><a href="<?php echo htmlSpecialChars($_control->link("Order:detail", array($order->id))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($order->id, ENT_NOQUOTES) ?></a></td>
<?php if ($order->sms_address): ?>
						<td colspan="2"><?php echo Nette\Templating\Helpers::escapeHtml($order->sms_address, ENT_NOQUOTES) ?></td>
<?php else: ?>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($order->customer_firstname, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($order->customer_lastname, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($order->customer_street, ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($order->customer_city, ENT_NOQUOTES) ?>
, <?php echo Nette\Templating\Helpers::escapeHtml($order->customer_zip, ENT_NOQUOTES) ?></td>
<?php endif ?>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($order->status, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($order->payment, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($template->price($order->total), ENT_NOQUOTES) ?> Kč</td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($template->date($order->ordered, 'j. n. Y'), ENT_NOQUOTES) ?></td>
						<td><?php if ($order->paid): echo Nette\Templating\Helpers::escapeHtml($template->date($order->paid, 'j. n. Y'), ENT_NOQUOTES) ;else: ?>
<a href="<?php echo htmlSpecialChars($_control->link("markPaid!", array($order->id))) ?>
">zaplaceno</a><?php endif ?></td>
						<td><?php if ($order->shipped): echo Nette\Templating\Helpers::escapeHtml($template->date($order->shipped, 'j. n. Y'), ENT_NOQUOTES) ;else: ?>
<a href="<?php echo htmlSpecialChars($_control->link("markShipped!", array($order->id))) ?>
">expedováno</a><?php endif ?></td>
						<td><?php echo $_form["order-$order->id"]->getControl()->addAttributes(array()) ?></td>
					</tr>
<?php $iterations++; endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="10" style="text-align: right">
						<?php if ($_label = $_form["action"]->getLabel()) echo $_label->addAttributes(array()) ?>
 <?php echo $_form["action"]->getControl()->addAttributes(array()) ?> <?php echo $_form["submit"]->getControl()->addAttributes(array()) ?>

					</td>
				</tr>
			</tfoot>
		</table>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;else: ?>
	Žádné objednávky.<br />
<?php endif ;