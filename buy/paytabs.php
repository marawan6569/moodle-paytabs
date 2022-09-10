<?php
function create_payment_page($request_body)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://secure.paytabs.sa/payment/request', // change to your region url
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'authorization: YOUR-SECRET-KEY',
            'Content-Type: application/json',
        ),
        CURLOPT_POSTFIELDS =>json_encode($request_body),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}


function verify_payment($trd)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://secure.paytabs.sa/payment/query', // change to your region url
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'authorization: YOUR-SECRET-KEY',
            'Content-Type: application/json',
        ),
        CURLOPT_POSTFIELDS =>json_encode(['profile_id' => 'YOUR_PROFILE_ID', 'tran_ref' => $trd]),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
