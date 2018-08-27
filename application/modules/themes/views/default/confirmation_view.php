<h1 class="detail-title"><i class="fa fa-user"></i>&nbsp;PAYMENT GATEWAY => SUCCESS SITE</h1>
<div class="row">
    <div class="col-md-12" style="min-height:300px">
        
        <p>PAYMENT GATEWAY => SUCCESS SITE</p>
<?php error_reporting(E_ALL);
ini_set('display_errors', 1); ?>

<?php

$user_id = $this->session->userdata('new_user_ref_id');
$this->load->model('user/user_model');
$r = $this->user_model->get_user_data_array_by_id($user_id);

$reference = $r['payment_reference'];

if(isset($_REQUEST['ref'])) {
    if ($_REQUEST['ref'] == $reference) {
        echo "Payment Success";
    }
    else{
        echo "Some error";
    }
}

 function sign($params, $api_key) {
 ksort($params);
 $base = implode(" ", $params);
 
 return hash_hmac("sha256", $base, $api_key);
 }
 
 $params = array(
 "version"      => "v10",
 "merchant_id"  => 883,
 "agreement_id" => 2173,
 "order_id"     => $user_id,
 "amount"       => 1000,
 "currency"     => "DKK",
 "payment_methods" => "creditcard, !jcb, !visa-us",
 "continue_url" => "http://www.lejibyen.dk/index.php/da/account/payment_processed/?u=".$user_id."&ref=".$reference,
 "cancel_url"   => "http://www.lejibyen.dk/?cancel",
 "callback_url" => "http://www.lejibyen.dk/?callback"
 );
 
$params["checksum"] = sign($params, "ece1c815c7b4570b9801f1869f91f69a3106c8bae6ad1253215038d2ae5b7889");
 ?>



<form method="POST" action="https://payment.quickpay.net" id="confirmation_form">
    <input type="hidden" name="version" value="v10">
    <input type="hidden" name="merchant_id" value="883">
    <input type="hidden" name="agreement_id" value="2173">
    <input type="hidden" name="order_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="amount" value="1000">
    <input type="hidden" name="currency" value="DKK">
    <input type="hidden" name="continueurl" value="http://www.lejibyen.dk/index.php/da/account/payment_processed/?u=<?php echo $user_id; ?>&ref=<?php echo $reference; ?>">
    <input type="hidden" name="cancelurl" value="http://www.lejibyen.dk/?cancel">
    <input type="hidden" name="callbackurl" value="http://www.lejibyen.dk/?callback">
    <input type="hidden" name="payment_methods" value="creditcard, !jcb, !visa-us">
    <input type="hidden" name="checksum" value="<?php echo $params["checksum"]; ?>">
    <input type="submit" value="Gå til betaling">
</form>


    </div>    
</div> <!-- /row -->


<script type="text/javascript">

    jQuery(document).ready(function(){

        jQuery('#confirmation_form').submit();

    });

</script>