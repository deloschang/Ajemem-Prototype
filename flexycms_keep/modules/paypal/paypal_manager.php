<?php
chdir(APP_ROOT."flexycms/classes/common");
include("paypal_class_ipn.php");
class paypal_manager extends mod_manager {
	function paypal_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'paypal');
		$this->obj_paypal = new paypal;
		//$this->paypal_bl = new paypal_bl;
		$this->paypal_form = new paypal_class();
 	} 
	function get_module_name() { 
		return 'paypal';
	}
	function get_manager_name() { 
		return 'paypal';
	}
	
	function _form($price='',$period='',$type='') {
		$iduser=$_SESSION['id_user']?$_SESSION['id_user']:0;
		$form['type'] ='donate';
		$form['business'] = $GLOBALS['conf']['PAYPAL']['business'];
		$form['item_name'] = "Donation";
//		$form['amount'] = 7;//$price; BY NOT PROVIDING THIS WILL ALLOW USER TO GIVE DONATE AMOUNT BY THEIR CHOICE
//		$form['period'] =2;//$period;
		$form['custom'] =date('Y-m-d H:i:s')."|".$iduser; 
//		$form['term'] = 'D';
//		$form['src'] = 1;//$type;//
		$form['currency_code'] = $GLOBALS['conf']['PAYPALPRO']['currency_code'];//'USD';
		$this->paypal_form->is_return=1;
		//To create the form You have to call 'form()' function with array as a argument.
		$paypal[]=$this->paypal_form->form($form);
		$this->paypal_form->title = 'donate';
		$paypal[]=$this->paypal_form->submitButton();
		print $paypal[0];
		print $paypal[1];
		return $paypal;
	}
	
################################################################
########  Function handle the IPN response from paypal  ########
## This function is called directly by Paypal as a callback ####
## feature. Thus, this may not work right if called via a direct
## invoke.
################################################################	
	function _ipn(){
		$paypal_info= $_POST;

		//*******************Below code snippet is for testing proposal.Please remove after testing.
		//$filepath=pathinfo(__file__);   //For the path,file to write 
		//$filepath =$filepath['dirname']; 
		//$handle = fopen("paypal.txt", "w+");
		//fwrite($handle,$_POST['payer_email']);
		//fclose($handle);
		//*******************End Below code snippet is for testing proposal
	
		$paypal_ipn = new paypal_class($paypal_info);
		
		// where to contact us if something goes wrong
		$paypal_ipn->error_email = $_POST['payer_email'];
		$paypal_ipn->fromemail = "webmaster@webmaster.com";
		
		// We send an identical response back to PayPal for verification
		$paypal_ipn->send_response();

		$handle = fopen(APP_ROOT."paypal_veri.txt", "a+");
		fwrite($handle,$paypal_ipn->verification()."\n\n\nverify");
		fwrite($handle,"\n\n".print_r($_REQUEST,1));
		fclose($handle);

		// PayPal will tell us whether or not this order is valid.
		if( !$paypal_ipn->verification() ){
			// bad order, someone must have tried to run this script manually
			$paypal_ipn->error_msg("Verification is invalid");
		}
			
		// payment status
		switch( $paypal_ipn->payment_status() ){
			case 'Completed':
				$paypal['payment_status']=$_REQUEST['payment_status'];
				$txn_id=$_REQUEST['txn_id'];
				$id=$this->obj_paypal->update_this("donate",$paypal,"txn_id='".$txn_id."'");
				break;
			case 'Pending':
				$custom=explode("|",$_REQUEST['custom']);
				$paypal['amount']=$_REQUEST['mc_gross'];
				$paypal['name']=$_REQUEST['address_name'];
				$paypal['donated_by']=$custom[1];
				$paypal['payer_email']=$_REQUEST['payer_email'];
				$paypal['payment_status']=$_REQUEST['payment_status'];
				$paypal['txn_id']=$_REQUEST['txn_id'];
				$paypal['donated_on']=$custom[0];
				$id=$this->obj_paypal->insert_all("donate",$paypal,1);
				// money isn't in yet, just quit.
				// paypal will contact this script again when it's ready
				$paypal_ipn->error_msg("Pending Payment");
				break;
			case 'Failed':
				// whoops, not enough money
				$paypal_ipn->error_msg("Failed Payment");
				break;
			case 'Denied':
				// denied payment by us
				// not sure what causes this one
				$paypal_ipn->error_msg("Denied Payment");
				break;
			default:
				// order is no good
				$paypal_ipn->error_msg("Unknown Payment Status" . $paypal_ipn->payment_status());
				break;
		} // end switch]

		//**************Below code snippet is for testing proposal.Please remove after testing.
		//foreach ($paypal_ipn as $key => $value){
		//	$t .= $key . " = " .$value ."\n\n";
		//}
		//$t = 'he i am';
		//$handle = fopen(APP_ROOT."paypal_test.txt", "w+");
		//fwrite($handle,$t);
		//fclose($handle);
		//*************End Below code snippet is for testing proposal
	}	
####################################################################
########  Function handle the success response from paypal  ########
####################################################################	
	function _return_success() {
		print "Thank You,Your transaction is successfully completed";
		redirect(LBL_SITE_URL);
	}
	
####################################################################
#######  Function handle the cancel response from paypal  ##########
####################################################################
	function _cancel() {
		print "Sorry,Your transaction is incompleted.Try again";
	}
};
?>
