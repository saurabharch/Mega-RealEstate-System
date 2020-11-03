<?php namespace App\Controllers;
 use Razorpay\Api\Api;
class Payment extends BaseController
{
   
  function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel'); 
        $this->UserModel      = model('UserModel');  
        helper('inflector'); 
        helper('number');  
	}


	function createAdsPayment()
	{   
		require APPPATH.'/libraries/razorpay-php/Razorpay.php'; 
		if($this->request->getPost('createAdsPayment'))
		{
			  $from  = $this->request->getPost('featured_from');
			  $upto  = $this->request->getPost('featured_upto');
			  $price = $this->request->getPost('adsPricePerDay');
			  $propertyId = $this->request->getPost('sPropertyId');
			  $adsType = $this->request->getPost('sAdsType');
	          
	            $timeUpto   = strtotime($upto); 
	            $timeFrom   = strtotime($from);
	            $diff = ($timeUpto - $timeFrom)/60/60/24; 
	            $days =  ($diff > 0) ? intval($diff) : 0 ; 
	            $adsDays =  $days + 1;
	            $totalAdsPrice = $price * $adsDays; 

	         $data = [
	           'property_id' => $propertyId, 
	           'ads_type' => $adsType, 
	           'total_amount' => $totalAdsPrice, 
	           'currency' => nowCurrency(),  
	           'payment_source' => 'Razor',
	           'payment_detail' => '',
	           'start_ad_from' => $from, 
	           'end_ad_on' => $upto,
	           'created_at'  => date('Y-m-d h:i:s'),
               'updated_at'  => date('Y-m-d h:i:s'),
               'status' => 1       
	         ];

    //           $order  = $client->order->create([
				//   'receipt'         => 'order_adsPid_'.$propertyId,
				//   'amount'          => $totalAdsPrice * 100, // amount in the smallest currency unit
				//   'currency'        => nowCurrency(),
				//   'payment_capture' =>  '0'
				// ]);

	            $html = '<form action="<?= base_url();?>/payment/createAdsPaymentCallback/" method="POST">
						<script
						    src="https://checkout.razorpay.com/v1/checkout.js"
						    data-key="rzp_test_cVLN1Uq6pnvRDw" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
						    data-amount="456" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
						    data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
						    data-order_id="order_CgmcjRh9ti2lP7"//Replace with the order_id generated by you in the backend.
						    data-buttontext="Pay with Razorpay"
						    data-name="PropertyRaja.com"
						    data-description="PropertyRaja Ads Paymennt"
						    data-image="https://example.com/your_logo.jpg"
						    data-prefill.name="Nishant Kumar"
						    data-prefill.email="gaurav.kumar@example.com"
						    data-theme.color="#F37254"
						></script>
						<input type="hidden" custom="Hidden Element" name="hidden">
						</form>';
				
             print_r($html);  
		}
	}

	function createAdsPaymentCallback()
	{
       print_r($_POST);
	} 

}	