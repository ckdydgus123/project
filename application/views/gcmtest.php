<?php

function sendGCM(){
    // Replace with the real server API key from Google APIs
    $apiKey = "AIzaSyBsd4Lh9Cp0gYFMLtfM880YndAkRr70utc"; //구글에서 발급받은 API키값

    $regid = $_REQUEST['regid']; // 디바이스 키값
    // Replace with the real client registration IDs
    $registrationIDs = array( $regid );

    // Message to be sent
    $message = iconv("EUC-KR", "UTF-8", "한글 테스트 TEST!!"); //보낼 메시지

    // Set POST variables
    $url = 'https://android.googleapis.com/gcm/send'; //GCM 전송URL

    $fields = array(
        'registration_ids' => $registrationIDs,
        'data' => array( "message" => $message ),
    );
    $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
    );

    // Open connection
    $ch = curl_init();

    // Set the URL, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url);
    curl_setopt( $ch, CURLOPT_POST, true);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));

    // Execute post
    $result = curl_exec($ch);

    // Close connection
    curl_close($ch);
    echo $result;
    //print_r($result);
    //var_dump($result);
}
sendGCM(); // 푸시알림 전송
?>