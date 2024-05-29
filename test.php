<?php

$url = 'https://app.whacenter.com/api/send';

$ch = curl_init($url);

$nohp= '081231760922';
$pesan= 'test langsung';
$file = 'https://simgajidprd-ponorogo.web.id/public/assets/images/auth-one-bg.jpg';

$data = array(
    'device_id' => '8c6c2bf2f88a90f295ea19bf74a05331',
    'number' => $nohp,
    'message' => $pesan,
    'file' => $file,

);
$payload = $data;
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>
