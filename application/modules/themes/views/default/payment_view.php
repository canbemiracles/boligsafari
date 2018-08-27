<?php


function sign($params, $api_key) {
    ksort($params);
    $base = implode(" ", $params);

    return hash_hmac("sha256", $base, $api_key);
}

$params = array(
    "version"      => "v10",
    "merchant_id"  => 883,
    "agreement_id" => 2173,
    "order_id"     => "1146",
    "amount"       => 1000,
    "currency"     => "DKK",
    "payment_methods" => "creditcard, !jcb, !visa-us",
    "continue_url" => "http://www.lejibyen.dk/",
    "cancel_url"   => "http://www.lejibyen.dk/?cancel",
    "callback_url" => "http://www.lejibyen.dk/?callback"
);

$params["checksum"] = sign($params, "ece1c815c7b4570b9801f1869f91f69a3106c8bae6ad1253215038d2ae5b7889");
?>



<form method="POST" action="https://payment.quickpay.net">
    <input type="hidden" name="version" value="v10">
    <input type="hidden" name="merchant_id" value="883">
    <input type="hidden" name="agreement_id" value="2173">
    <input type="hidden" name="order_id" value="000">
    <input type="hidden" name="amount" value="1000">
    <input type="hidden" name="currency" value="DKK">
    <input type="hidden" name="continueurl" value="http://www.lejibyen.dk/">
    <input type="hidden" name="cancelurl" value="http://www.lejibyen.dk/?cancel">
    <input type="hidden" name="callbackurl" value="http://www.lejibyen.dk/?callback">
    <input type="hidden" name="payment_methods" value="creditcard, !jcb, !visa-us">
    <input type="hidden" name="checksum" value="<?php echo $params["checksum"]; ?>">
    <input type="submit" value="Go to payment">
</form>
