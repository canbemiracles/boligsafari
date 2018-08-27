<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.quickpay.net/subscriptions/38587/recurring");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);


$headers = array(
    'Accept-Version: v10',
    'Authorization: BASIC 20a36fc6c0227817debb076a382321e8d85919a8bd9e3eafa701035ed8e90307'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$data = array(
    'id' => '38587',
    'order_id' => '1039',
    'currency' => 'DKK',
    'amount' => '350'
);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo $info;
echo $output;

?>
