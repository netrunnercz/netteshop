<?php

namespace FrontModule;


class SmsPresenter extends BasePresenter {

	protected function startup() {
		parent::startup();
	}

	public function renderDefault() {
		$get = $this->context->httpRequest->getQuery();
		$products = unserialize($get["p"]);
		$address = $get["a"];
		$phone = $get["ph"];
		$country = $get["c"];
		
		if(!empty($products) && !empty($address) && !empty($phone)) {
			$order = new \Order($this->context->database);
			
			$id  = $order->createSms($address, $phone);
			if($country == "cz")
				$order->setPayment($id, 'prevod');
			else
				$order->setPayment($id, 'slovensko');
			$order->insertItems($id, $products);
			if($country == "cz")
				$order->setPostage($id, 2);
			else
				$order->setPostage($id, 3);
			
			$information = $order->getInformation($id);
			
			if($country == "cz")
				$total = $information->total;
			else
				$total = $information->total / 25;
			
			if($total - (int)$total)
				$t = number_format($total, 2, ",", "");
			else
				$t = number_format($total, 0, ",", "");
			
			$s = array($information->id, $t);
			$this->template->s = serialize($s);
		}
	}
}