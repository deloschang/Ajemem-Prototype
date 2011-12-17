<<<<<<< HEAD
<?php
/*
******************************************************************************************************************
* PayPal is an e-commerce business allowing payments and money transfers to be made through the  Internet.
* PayPal is an account-based system that lets anyone with an email address securely send and  receive online payments.
* Use your existing account, or sign-up during paypal transaction.
* PayPal is a Web-based application for the secure transfer of funds between member accounts. It  doesn't cost the user anything to join PayPal or to send money through the service, but there is  a fee structure in place for those members who wish to receive money.

*  IPN(Instant Payment Notification)-->Paypal send a transaction status notice just after the money                                       is deducted from payers account.

******************************************************************************************************************

* Please follow the corresponding data fields/variables in the payment form....

	business-->Your PayPal ID or an email address associated with your PayPal account.Money pay 				               conformation will be send to this email.
	return--> return contain the path/url where user comes after successfully paypal payment.
	notify_url-->It contain the path/url where the paypal send the IPN.
	cancel_return-->It contain the path/url where a user will return if he canceled his transaction.
	charset-->Sets the character encoding for the billing information/log-in page, for the Information you send to PayPal in your HTML button code, and for the information that PayPal returns to you as a result of checkout processes initiated by the payment button.
	no_note-->Do not prompt payers to include a note with their payments.
	          1 – hide the text box and the prompt.
	a3-->Regular subscription price;
	t3--->Regular subscription units of duration. Allowable values:
          D – for days; allowable range for p3 is 1 to 90
          W – for weeks; allowable range for p3 is 1 to 52
          M – for months; allowable range for p3 is 1 to 24
          Y – for years; allowable range for p3 is 1 to 5

	p3--->Subscription duration. Specify an integer value in the allowable range for the units of duration that you specify with t3.
	src-->Recurring payments. Subscription payments recur unless subscribers cancel their subscriptions.
		*0 – subscription payments do not recur  *1 – subscription payments recur

          0 – subscription payments do not recur
          1 – subscription payments recur
	sra-->Reattempt on failure. If a recurring payment fails, PayPal attempts to collect the payment two more times before canceling the subscription.
          0 – do not reattempt failed recurring payments
          1 – reattempt failed recurring payments before canceling

	rm-->Return method. The FORM METHOD used to send data to the URL specified by the return variable after payment completion.
         0 – all shopping cart transactions use the GET method
         1 – the payer’s browser is redirected to the return URL by the GET method, and no transaction variables are sent
         2 – the payer’s browser is redirected to the return URL by the POST method, and all transaction variables are also posted
	cmd-->1. _xclick ==  The button that the person clicked was a Buy Now button.
	      2. _xclick-subscriptions == The button that the person clicked was a Subscribe button.
		  3. _donations == The button that the person clicked was a Donate button.
		  5. _cart == For shopping cart purchases; these additional variables specify the kind of shopping cart button that the person clicked.
                add – Add to Cart buttons for the PayPal Shopping Cart
                display – View Cart buttons for the PayPal Shopping Cart
                upload – The Cart Upload command for third party carts
		  6. _subscr-find == The button that the person clicked was a unsubscription button.

********************************************************************************************************************
 $return -- The URL to which the payer’s browser is redirected after completing the payment; for example, a URL on your site that displays a “Thank you for your payment” page.

  $cancel -- A URL to which the payer’s browser is redirected if payment is cancelled; for example,a URL on your website that displays a “Payment Canceled” page.

 $ipn --    The URL to which PayPal posts information about the transaction, in the form of Instant Payment Notification messages.

$form['type'] ='subscribe';   --->type is for which type of paypal form
$form['amount'] = '';         --->amount is for total price for subscription,paypal                                          variable is a3.
$form['term'] ='';            --->term is for subscription time,like Day,Week,Month and                                          Year.
$form['period'] =1;         --->period is for numeric value of term,Example period '1'                                          and term 'month' means subscription is for one month.
$form['item_name'] = 'Afixi Member'; ---->Name of the product.
$form['item_number'] =1;             ---->Unique id or number of a product.
$form['business'] ='bijit_1262254538_biz@gmail.com';     ---> merchants Email id.
$form['custom'] = 1;
$form['no_notes'] = 1;
$form['shipping'] = '';           ------>Charge value for shipping of a product.
$form['handling'] = '';           ------>Charge value of tax of a product.

*/

//Class for paypal transaction
class paypal_class {
	var $paypal_post_vars;
	//var $timeout;
	var $url_string;
	var $paypal_url;
	var $return_url='';
	var $cancel_url='';
	var $ipn_url='';
	var $file_class_path;
	var $class_path;
	var $title ='';
	var $src ='';
	var $filepath='';
	var $button_name;
	var $button_height='auto';
	var $button_width='auto';
	var $is_return;
	var $alt="Make payments with PayPal - it&#8217s fast, free and secure!";

//Start--- creation of form
####################################################################
####################################################################
####################################################################
//This function is for assigning POST variable information send by paypal after transaction
	function paypal_class($paypal_post_vars=''){
		$this->class_path = __file__;   //find the path of class file
		$this->filepath=pathinfo($this->class_path);   //For the path,file to write
		$this->filepath =$this->filepath['dirname'];   //End

		$this->paypal_post_vars = $paypal_post_vars;
		$this->timeout = 30;
		if($GLOBALS['conf']['PAYPAL']['paypal_mode']=='sandbox'){
			$this->paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
			$this->url_string = "https://www.sandbox.paypal.com/cgi-bin/webscr?";
		}else{
			$this->paypal_url = "https://www.paypal.com/cgi-bin/webscr";
			$this->url_string = "https://www.paypal.com/cgi-bin/webscr?";
		}
	}//End of constructor

####################################################################
####################################################################
####################################################################
//This function is for deciding paypal form action,retun,ipn,cancel and string  Url
	function form($form=array()) {
		if($this->return_url ==''){
			$this->return_url =LBL_SITE_URL."index.php/paypal/return_success";
		}
		if($this->ipn_url =='') {
			$this->ipn_url =LBL_SITE_URL."index.php/paypal/ipn";
		}
		if($this->cancel_url =='') {
			$this->cancel_url =LBL_SITE_URL."index.php/paypal/cancel";
		}
		//Form for paypal payment
		switch($form['type']) {
			case 'pay now':
				//$default_title = 'Pay Now';
				$form['cmd']='_xclick';
				$form['charset']=1;
				$form['rm']=2;
				$form['no_notes']=1;
				break;
			case 'subscribe':
				//$default_title = 'Subscribe';
				//$array['no_shipping'] = 1;
				$form['no_notes']=1;
				$form['src'] = $form['src'];
				$form['sra'] = 1;
				$form['charset']=1;
				$form['rm']=2;
				$form['business']= $GLOBALS['conf']['PAYPAL']['business'];//'gfhgjh';
				$form = $this->subscribeoptions($form);//print '<pre>';print_r($form);exit;
				$form['cmd']='_xclick-subscriptions';
				break;
			case 'donate':
				//$default_title = 'Donate';
				$form['no_notes']=1;
				$form['cmd'] = '_donations';
				break;
			case 'addtocart'://add – Add to Cart buttons for the PayPal Shopping Cart
				//$default_title = 'Add to Cart';
				$form['no_notes']=1;
				$form['cmd'] = '_cart';
				$form['add'] = 1;
				break;
			case 'unsubscribe':
				$form['cmd'] = '_subscr-find';
        			$form['alias'] = $form['business'];
	        		$default_title = 'Unsubscribe';
				break;
			case 'cart': //upload cart  //The Cart Upload command for third party carts
				$form['cmd'] = '_cart';
				$form['upload'] = 1;
				$form['no_notes']=1;
				$default_title = 'Checkout';
				$form = $this->uploadCartOptions($form);
				break;
		}
		$formval= "\n\n<form action='".$this->paypal_url."' method='post' name='paypal_form' onSubmit='return chkvalid();'>\n";
		$formval.= "<input type='hidden' name='return' value='".$this->return_url."'/>\n";
		$formval.= "<input type='hidden' name='notify_url' value='".$this->ipn_url."'/>\n";
		$formval.= "<input type='hidden' name='cancel_return' value='".$this->cancel_url."'/>\n";
		foreach($form as $name => $value){
			if($name !='type') {
				$formval .= "<input type='hidden' name='$name' id='pay_".$name."' value='$value' />\n";
			}
		}
		$this->title='';
		$this->src='';
		if($this->is_return) {
			return $formval;
		}else{
			echo $formval;
		}
	} //End of paypal_form function
###########################################################
###########################################################
###########################################################
//function for creating  payment buttons
	function submitButton() {
		switch($this->title) {
			case 'subscribe':
				$h = $this->button_height;$w = $this->button_width;$a = $this->alt;
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-but20.gif' border='0' height='$h' width='$w' name='submit' alt='$a'>\n</form>";
				break;
			case 'donate':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'addtocart':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif'  height='$this->button_height' width='$this->button_width' border='0' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'unsubscribe':
				 $this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_unsubscribe_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'checkout':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'><img src='https://www.paypal.com/en_US/i/scr/pixel.gif'/>\n</form>";
				break;
			case 'button':
				$this->str="<input type='submit'  border='0'  height='$this->button_height' width='$this->button_width' name='submit' value='$this->button_name' alt='$this->alt'>\n</form>";
				break;
			case 'self':
				$this->str="<input type='image' src='$this->src' border='0'  height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			default:
				$this->str= "<input type='image'  name='button'  height='$this->button_height' width='$this->button_width'src='https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif' alt='$this->alt' /><img src='https://www.paypal.com/en_US/i/scr/pixel.gif'/>\n</form>";
				break;
		}
		if($this->is_return) {
			return $this->str;
		}else{
			echo $this->str;
		}
	}//End of paypal button creation function
//End--- creation of form

###########################################################
###########################################################
###########################################################
//Function for subscription timing
	function subscribeoptions($form=array()) {
		if(isset($form['period'])){
			$form['p3'] = $form['period'];
			unset($form['period']);
		}
		//Amount billed
		if(isset($form['amount'])){
			$form['a3'] = $form['amount'];
			unset($form['amount']);
		}
		//Terms, Month(s), Day(s), Week(s), Year(s)
		if(isset($form['term'])){
			switch($form['term']){
				case 'month': $form['t3'] = 'M'; break;
				case 'year': $form['t3'] = 'Y'; break;
				case 'day': $form['t3'] = 'D'; break;
				case 'week': $form['t3'] = 'W'; break;
				default: $form['t3'] = $form['term'];
			}
			unset($form['term']);
		}
		return $form;
	} //End of subscribeoptions function

###########################################################
###########################################################
###########################################################
//function to create form for multiple items
	function uploadCartOptions($form = array()){
		if(isset($form['items']) && is_array($form['items'])){
			$count = 1;
			foreach($form['items'] as $item){
				foreach($item as $key => $value){
					$form[$key.'_'.$count] = $value;
				}
				$count++;
			}
			unset($form['items']);
		}
		return $form;
	}//End of uploadCartOptions function

####################################################################
####################################################################
####################################################################
// sends response back to paypal
	function send_response(){
		// put all POST variables received from Paypal back into a URL encoded string
		foreach($this->paypal_post_vars as $key => $value){
			// if magic quotes gpc is on, PHP added slashes to the values so we need
			// to strip them before we send the data back to Paypal.
			if( @get_magic_quotes_gpc()){
				$value = stripslashes($value);
			}
			// make an array of URL encoded values
			$values[] = "$key" . "=" . urlencode($value);
		}
		// join the values together into one url encoded string
		$this->url_string .= @implode("&", $values);
		$this->url_string .= "&cmd=_notify-validate"; // add paypal cmd variable

		//************************* This is for testing propasal to check the string url
		//$handle = fopen($this->filepath."/file.txt", "w+");
		//fwrite($handle,$this->url_string);
		//fclose($handle);
		//************************* End check the string url

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $this->url_string);
		//curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; www.ScriptDevelopers.NET; PayPal IPN Class)");
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_TIMEOUT, $this->timeout);
		$this->paypal_response = curl_exec ($ch);

		//************************* This is for testing propasal to check response
		//$handle = fopen($this->filepath."/file2.txt", "w+");
		//fwrite($handle,$this->paypal_response);
		//fclose($handle);
		//************************* End check response

		curl_close($ch);//END send post through CURL
	}// End function send_response()
####################################################################
####################################################################
####################################################################
//This function is for check the result of verification sent by paypal
	function verification(){
		if( ereg("VERIFIED", $this->paypal_response) ){
			return true;
		}else{
			return false;
		}
	} // end function is_verified

####################################################################
####################################################################
####################################################################
// writes error to logfile, exits script
	function error_msg($message) {
		$date = date("D M j G:i:s T Y", time());
		$message .= "\n\nThe following input was received from (and sent back to) PayPal:\n\n";
		while( @list($key,$value) = @each($this->paypal_post_vars) ){
			$message .= $key . ':' . " \t$value\n";
		}
		$message .= "\n\n" . $this->url_string . "\n\n" . $this->paypal_response;

		//send error email
		if( $this->error_email ){
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: ".$this->fromemail."\r\n";
			//mail($this->error_email, $date."<br/>"$message, $headers);//Please uncomment of you need to send email,if error occured.
		}//End send error email

		// write error  to file?
		$handle = fopen($this->filepath."/error_log_file.txt", "w+");
		fwrite($handle, $message);
		fclose($handle);
		exit;
	}//End of error_msg function

####################################################################
####################################################################
####################################################################
//check the payment status
	function payment_status(){
		//************************ For checking the response varables
		//foreach ($this->paypal_post_vars as $key => $value){
		//	$text .= $key . " = " .$value ."\n\n";
		//}
		//$handle = fopen($this->filepath."/paypal_info.txt", "w+");
		//fwrite($handle,$text);
		//fclose($handle);
		//************************ End checking the response varables
		return $this->paypal_post_vars['payment_status'];
	}//End of payment_status function
}//End of paypal class
?>
=======
<?php
/*
******************************************************************************************************************
* PayPal is an e-commerce business allowing payments and money transfers to be made through the  Internet.
* PayPal is an account-based system that lets anyone with an email address securely send and  receive online payments.
* Use your existing account, or sign-up during paypal transaction.
* PayPal is a Web-based application for the secure transfer of funds between member accounts. It  doesn't cost the user anything to join PayPal or to send money through the service, but there is  a fee structure in place for those members who wish to receive money.

*  IPN(Instant Payment Notification)-->Paypal send a transaction status notice just after the money                                       is deducted from payers account.

******************************************************************************************************************

* Please follow the corresponding data fields/variables in the payment form....

	business-->Your PayPal ID or an email address associated with your PayPal account.Money pay 				               conformation will be send to this email.
	return--> return contain the path/url where user comes after successfully paypal payment.
	notify_url-->It contain the path/url where the paypal send the IPN.
	cancel_return-->It contain the path/url where a user will return if he canceled his transaction.
	charset-->Sets the character encoding for the billing information/log-in page, for the Information you send to PayPal in your HTML button code, and for the information that PayPal returns to you as a result of checkout processes initiated by the payment button.
	no_note-->Do not prompt payers to include a note with their payments.
	          1 – hide the text box and the prompt.
	a3-->Regular subscription price;
	t3--->Regular subscription units of duration. Allowable values:
          D – for days; allowable range for p3 is 1 to 90
          W – for weeks; allowable range for p3 is 1 to 52
          M – for months; allowable range for p3 is 1 to 24
          Y – for years; allowable range for p3 is 1 to 5

	p3--->Subscription duration. Specify an integer value in the allowable range for the units of duration that you specify with t3.
	src-->Recurring payments. Subscription payments recur unless subscribers cancel their subscriptions.
		*0 – subscription payments do not recur  *1 – subscription payments recur

          0 – subscription payments do not recur
          1 – subscription payments recur
	sra-->Reattempt on failure. If a recurring payment fails, PayPal attempts to collect the payment two more times before canceling the subscription.
          0 – do not reattempt failed recurring payments
          1 – reattempt failed recurring payments before canceling

	rm-->Return method. The FORM METHOD used to send data to the URL specified by the return variable after payment completion.
         0 – all shopping cart transactions use the GET method
         1 – the payer’s browser is redirected to the return URL by the GET method, and no transaction variables are sent
         2 – the payer’s browser is redirected to the return URL by the POST method, and all transaction variables are also posted
	cmd-->1. _xclick ==  The button that the person clicked was a Buy Now button.
	      2. _xclick-subscriptions == The button that the person clicked was a Subscribe button.
		  3. _donations == The button that the person clicked was a Donate button.
		  5. _cart == For shopping cart purchases; these additional variables specify the kind of shopping cart button that the person clicked.
                add – Add to Cart buttons for the PayPal Shopping Cart
                display – View Cart buttons for the PayPal Shopping Cart
                upload – The Cart Upload command for third party carts
		  6. _subscr-find == The button that the person clicked was a unsubscription button.

********************************************************************************************************************
 $return -- The URL to which the payer’s browser is redirected after completing the payment; for example, a URL on your site that displays a “Thank you for your payment” page.

  $cancel -- A URL to which the payer’s browser is redirected if payment is cancelled; for example,a URL on your website that displays a “Payment Canceled” page.

 $ipn --    The URL to which PayPal posts information about the transaction, in the form of Instant Payment Notification messages.

$form['type'] ='subscribe';   --->type is for which type of paypal form
$form['amount'] = '';         --->amount is for total price for subscription,paypal                                          variable is a3.
$form['term'] ='';            --->term is for subscription time,like Day,Week,Month and                                          Year.
$form['period'] =1;         --->period is for numeric value of term,Example period '1'                                          and term 'month' means subscription is for one month.
$form['item_name'] = 'Afixi Member'; ---->Name of the product.
$form['item_number'] =1;             ---->Unique id or number of a product.
$form['business'] ='bijit_1262254538_biz@gmail.com';     ---> merchants Email id.
$form['custom'] = 1;
$form['no_notes'] = 1;
$form['shipping'] = '';           ------>Charge value for shipping of a product.
$form['handling'] = '';           ------>Charge value of tax of a product.

*/

//Class for paypal transaction
class paypal_class {
	var $paypal_post_vars;
	//var $timeout;
	var $url_string;
	var $paypal_url;
	var $return_url='';
	var $cancel_url='';
	var $ipn_url='';
	var $file_class_path;
	var $class_path;
	var $title ='';
	var $src ='';
	var $filepath='';
	var $button_name;
	var $button_height='auto';
	var $button_width='auto';
	var $is_return;
	var $alt="Make payments with PayPal - it&#8217s fast, free and secure!";

//Start--- creation of form
####################################################################
####################################################################
####################################################################
//This function is for assigning POST variable information send by paypal after transaction
	function paypal_class($paypal_post_vars=''){
		$this->class_path = __file__;   //find the path of class file
		$this->filepath=pathinfo($this->class_path);   //For the path,file to write
		$this->filepath =$this->filepath['dirname'];   //End

		$this->paypal_post_vars = $paypal_post_vars;
		$this->timeout = 30;
		if($GLOBALS['conf']['PAYPAL']['paypal_mode']=='sandbox'){
			$this->paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
			$this->url_string = "https://www.sandbox.paypal.com/cgi-bin/webscr?";
		}else{
			$this->paypal_url = "https://www.paypal.com/cgi-bin/webscr";
			$this->url_string = "https://www.paypal.com/cgi-bin/webscr?";
		}
	}//End of constructor

####################################################################
####################################################################
####################################################################
//This function is for deciding paypal form action,retun,ipn,cancel and string  Url
	function form($form=array()) {
		if($this->return_url ==''){
			$this->return_url =LBL_SITE_URL."index.php/paypal/return_success";
		}
		if($this->ipn_url =='') {
			$this->ipn_url =LBL_SITE_URL."index.php/paypal/ipn";
		}
		if($this->cancel_url =='') {
			$this->cancel_url =LBL_SITE_URL."index.php/paypal/cancel";
		}
		//Form for paypal payment
		switch($form['type']) {
			case 'pay now':
				//$default_title = 'Pay Now';
				$form['cmd']='_xclick';
				$form['charset']=1;
				$form['rm']=2;
				$form['no_notes']=1;
				break;
			case 'subscribe':
				//$default_title = 'Subscribe';
				//$array['no_shipping'] = 1;
				$form['no_notes']=1;
				$form['src'] = $form['src'];
				$form['sra'] = 1;
				$form['charset']=1;
				$form['rm']=2;
				$form['business']= $GLOBALS['conf']['PAYPAL']['business'];//'gfhgjh';
				$form = $this->subscribeoptions($form);//print '<pre>';print_r($form);exit;
				$form['cmd']='_xclick-subscriptions';
				break;
			case 'donate':
				//$default_title = 'Donate';
				$form['no_notes']=1;
				$form['cmd'] = '_donations';
				break;
			case 'addtocart'://add – Add to Cart buttons for the PayPal Shopping Cart
				//$default_title = 'Add to Cart';
				$form['no_notes']=1;
				$form['cmd'] = '_cart';
				$form['add'] = 1;
				break;
			case 'unsubscribe':
				$form['cmd'] = '_subscr-find';
        			$form['alias'] = $form['business'];
	        		$default_title = 'Unsubscribe';
				break;
			case 'cart': //upload cart  //The Cart Upload command for third party carts
				$form['cmd'] = '_cart';
				$form['upload'] = 1;
				$form['no_notes']=1;
				$default_title = 'Checkout';
				$form = $this->uploadCartOptions($form);
				break;
		}
		$formval= "\n\n<form action='".$this->paypal_url."' method='post' name='paypal_form' onSubmit='return chkvalid();'>\n";
		$formval.= "<input type='hidden' name='return' value='".$this->return_url."'/>\n";
		$formval.= "<input type='hidden' name='notify_url' value='".$this->ipn_url."'/>\n";
		$formval.= "<input type='hidden' name='cancel_return' value='".$this->cancel_url."'/>\n";
		foreach($form as $name => $value){
			if($name !='type') {
				$formval .= "<input type='hidden' name='$name' id='pay_".$name."' value='$value' />\n";
			}
		}
		$this->title='';
		$this->src='';
		if($this->is_return) {
			return $formval;
		}else{
			echo $formval;
		}
	} //End of paypal_form function
###########################################################
###########################################################
###########################################################
//function for creating  payment buttons
	function submitButton() {
		switch($this->title) {
			case 'subscribe':
				$h = $this->button_height;$w = $this->button_width;$a = $this->alt;
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-but20.gif' border='0' height='$h' width='$w' name='submit' alt='$a'>\n</form>";
				break;
			case 'donate':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'addtocart':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif'  height='$this->button_height' width='$this->button_width' border='0' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'unsubscribe':
				 $this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_unsubscribe_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			case 'checkout':
				$this->str="<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif' border='0' height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'><img src='https://www.paypal.com/en_US/i/scr/pixel.gif'/>\n</form>";
				break;
			case 'button':
				$this->str="<input type='submit'  border='0'  height='$this->button_height' width='$this->button_width' name='submit' value='$this->button_name' alt='$this->alt'>\n</form>";
				break;
			case 'self':
				$this->str="<input type='image' src='$this->src' border='0'  height='$this->button_height' width='$this->button_width' name='submit' alt='$this->alt'>\n</form>";
				break;
			default:
				$this->str= "<input type='image'  name='button'  height='$this->button_height' width='$this->button_width'src='https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif' alt='$this->alt' /><img src='https://www.paypal.com/en_US/i/scr/pixel.gif'/>\n</form>";
				break;
		}
		if($this->is_return) {
			return $this->str;
		}else{
			echo $this->str;
		}
	}//End of paypal button creation function
//End--- creation of form

###########################################################
###########################################################
###########################################################
//Function for subscription timing
	function subscribeoptions($form=array()) {
		if(isset($form['period'])){
			$form['p3'] = $form['period'];
			unset($form['period']);
		}
		//Amount billed
		if(isset($form['amount'])){
			$form['a3'] = $form['amount'];
			unset($form['amount']);
		}
		//Terms, Month(s), Day(s), Week(s), Year(s)
		if(isset($form['term'])){
			switch($form['term']){
				case 'month': $form['t3'] = 'M'; break;
				case 'year': $form['t3'] = 'Y'; break;
				case 'day': $form['t3'] = 'D'; break;
				case 'week': $form['t3'] = 'W'; break;
				default: $form['t3'] = $form['term'];
			}
			unset($form['term']);
		}
		return $form;
	} //End of subscribeoptions function

###########################################################
###########################################################
###########################################################
//function to create form for multiple items
	function uploadCartOptions($form = array()){
		if(isset($form['items']) && is_array($form['items'])){
			$count = 1;
			foreach($form['items'] as $item){
				foreach($item as $key => $value){
					$form[$key.'_'.$count] = $value;
				}
				$count++;
			}
			unset($form['items']);
		}
		return $form;
	}//End of uploadCartOptions function

####################################################################
####################################################################
####################################################################
// sends response back to paypal
	function send_response(){
		// put all POST variables received from Paypal back into a URL encoded string
		foreach($this->paypal_post_vars as $key => $value){
			// if magic quotes gpc is on, PHP added slashes to the values so we need
			// to strip them before we send the data back to Paypal.
			if( @get_magic_quotes_gpc()){
				$value = stripslashes($value);
			}
			// make an array of URL encoded values
			$values[] = "$key" . "=" . urlencode($value);
		}
		// join the values together into one url encoded string
		$this->url_string .= @implode("&", $values);
		$this->url_string .= "&cmd=_notify-validate"; // add paypal cmd variable

		//************************* This is for testing propasal to check the string url
		//$handle = fopen($this->filepath."/file.txt", "w+");
		//fwrite($handle,$this->url_string);
		//fclose($handle);
		//************************* End check the string url

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $this->url_string);
		//curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; www.ScriptDevelopers.NET; PayPal IPN Class)");
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_TIMEOUT, $this->timeout);
		$this->paypal_response = curl_exec ($ch);

		//************************* This is for testing propasal to check response
		//$handle = fopen($this->filepath."/file2.txt", "w+");
		//fwrite($handle,$this->paypal_response);
		//fclose($handle);
		//************************* End check response

		curl_close($ch);//END send post through CURL
	}// End function send_response()
####################################################################
####################################################################
####################################################################
//This function is for check the result of verification sent by paypal
	function verification(){
		if( ereg("VERIFIED", $this->paypal_response) ){
			return true;
		}else{
			return false;
		}
	} // end function is_verified

####################################################################
####################################################################
####################################################################
// writes error to logfile, exits script
	function error_msg($message) {
		$date = date("D M j G:i:s T Y", time());
		$message .= "\n\nThe following input was received from (and sent back to) PayPal:\n\n";
		while( @list($key,$value) = @each($this->paypal_post_vars) ){
			$message .= $key . ':' . " \t$value\n";
		}
		$message .= "\n\n" . $this->url_string . "\n\n" . $this->paypal_response;

		//send error email
		if( $this->error_email ){
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: ".$this->fromemail."\r\n";
			//mail($this->error_email, $date."<br/>"$message, $headers);//Please uncomment of you need to send email,if error occured.
		}//End send error email

		// write error  to file?
		$handle = fopen($this->filepath."/error_log_file.txt", "w+");
		fwrite($handle, $message);
		fclose($handle);
		exit;
	}//End of error_msg function

####################################################################
####################################################################
####################################################################
//check the payment status
	function payment_status(){
		//************************ For checking the response varables
		//foreach ($this->paypal_post_vars as $key => $value){
		//	$text .= $key . " = " .$value ."\n\n";
		//}
		//$handle = fopen($this->filepath."/paypal_info.txt", "w+");
		//fwrite($handle,$text);
		//fclose($handle);
		//************************ End checking the response varables
		return $this->paypal_post_vars['payment_status'];
	}//End of payment_status function
}//End of paypal class
?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
