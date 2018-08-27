<h3>Afventer betalingsvindue.....</h3>

<?php

$user_id = $this->session->userdata('new_user_ref_id')+5000;
$user_ref = $this->session->userdata('new_user_ref_id');
$this->load->model('user/user_model');
$r = $this->user_model->get_user_data_array_by_id($user_ref);

$reference = $r['payment_reference'];


function sign($params, $api_key) {
    ksort($params);
    $base = implode(" ", $params);

    return hash_hmac("sha256", $base, $api_key);
}

$params = array(
    "version"      => "v10",
    "merchant_id"  => 883,
    "agreement_id" => 2172,
    "order_id"     => $user_id,
    "language"     => "da",
    "description"  => "Abonnement",
    "subscription" => 1,
    "autocapture"  => 1,
    "amount"       => 1000,
    "currency"     => "DKK",
    "payment_methods" => "creditcard",
    "continue_url" => "http://www.lejibyen.dk/index.php/da/account/payment_processed/?u=".$user_id."&ref=".$reference,
    "cancel_url"   => "http://www.lejibyen.dk/?cancel",
    "callback_url" => "http://www.lejibyen.dk/?callback"
);

$params["checksum"] = sign($params, "20a36fc6c0227817debb076a382321e8d85919a8bd9e3eafa701035ed8e90307");
?>



<form method="POST" action="https://payment.quickpay.net" id="confirmation_form">
    <input type="hidden" name="version" value="v10">
    <input type="hidden" name="merchant_id" value="883">
    <input type="hidden" name="agreement_id" value="2172">
    <input type="hidden" name="order_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="amount" value="1000">
    <input type="hidden" name="language" value="da">
    <input type="hidden" name="description" value="Abonnement"> 
    <input type="hidden" name="subscription" value="1">
    <input type="hidden" name="autocapture" value="1">
    <input type="hidden" name="currency" value="DKK">
    <input type="hidden" name="continueurl" value="http://www.lejibyen.dk/index.php/da/account/payment_processed/?u=<?php echo $user_id; ?>&ref=<?php echo $reference; ?>">
    <input type="hidden" name="cancelurl" value="http://www.lejibyen.dk/?cancel">
    <input type="hidden" name="callbackurl" value="http://www.lejibyen.dk/?callback">
    <input type="hidden" name="payment_methods" value="creditcard">
    <input type="hidden" name="checksum" value="<?php echo $params["checksum"]; ?>">
</form>

<?php echo $user_id; ?>

</div>
</div> <!-- /row -->


<script type="text/javascript">

    jQuery(document).ready(function(){

        jQuery('#confirmation_form').submit();

    });

</script>