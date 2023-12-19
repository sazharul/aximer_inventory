<?php

function send_sms($body, $number)
{
    $to = $number;
    $token = "102111352361698306756ba4fd51795e897578eda80b9dc8782ce";
    $message = $body;

    $url = "http://api.greenweb.com.bd/api.php?json";


    $data = array(
        'to' => "$to",
        'message' => "$message",
        'token' => "$token"
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);

    //Result
    //echo $smsresult;

   //Error Display
    curl_close($ch);


}

//function send_sms($body, $number)
//{
//    $url = "https://a2p.solutionsclan.com/api/sms/send";
//    $data = [
//        'apiKey' => 'A0001516febbc75-097b-4f8b-ac8e-e9b3773d39b3',
//        'contactNumbers' => $number,
//        'senderId' => '8809612441282',
//        'textBody' => $body
//    ];
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//    $response = curl_exec($ch);
////echo "$response";
//    curl_close($ch);
//}
