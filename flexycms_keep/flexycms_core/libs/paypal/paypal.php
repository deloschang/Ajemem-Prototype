<?php

class paypal{
	var $type = 0;
	var $NORMAL = 0;
	var $SUBSCRIPTION = 1;
	var $cmd;
	var $merchant_id;
	var $return_url;
	var $cancel_return_url;
	var $item_name; // ITEM REFERENCE NAME
	var $item_no; //REFERENCE NO
	var $currency = "USD";
	var $trials = array();
	var $amount;
	var $period = '1';
	var $time;
	var $MONTHLY = 'M';
	var $WEEKLY = 'W';
	var $YEARLY = 'Y';
	
	function paypal($type,$merchant_id){
		$this->type = $type;
		$this->$merchant_id = $merchant_id;
		if($type){
			$this->cmd = '_xclick-subscriptions';
		}else{
			$this->cmd = '_xclick';
		}
	}
	
	function set_return($return_url,$cancel_return_url){
		$this->return_url = $return_url;
		$this->cancel_return_url = $cancel_return_url;
	}
	
// REFER HERE FOR ANY PROBLEMS - FOR BOTH PAYPAL AND PHP
	function set_payment($amount,$period='',$time=''){
		$this->amount = $amount;
		$this->period = $period;
		$this->time = $time;
	}
	
	function set_trials($amount='0',$period='1',$time='M'){
		$cnt = count($this->trails);
		if($cnt < 2){ //Paypal allows only to trials
			$this->trials[$cnt]['amount'] = $amount;
			$this->trials[$cnt]['period'] = $period;
			$this->trials[$cnt]['time'] = $time;
		}else{
			$this->error = "MORE THAN TWO TRAIL PERIODS CAN'T BE SET";
		}
		
	}
	
	function set_item_details($item_name='',$item_no){
		$this->item_name = $item_name;
		$this->item_no = $item_no;
	}
}
