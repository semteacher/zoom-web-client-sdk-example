<?php
//laod API keys (only)
require_once(dirname(__FILE__, 2) . DIRECTORY_SEPARATOR .'keys.php');
//get into moodle // dirty and unsafe!
require_once(dirname(__FILE__, 3) . DIRECTORY_SEPARATOR .'config.php');

// if you're passing in a JSON object, decode it first
$meetingData 	= json_decode(file_get_contents('php://input'), true);

// Make sure your variable names match; ex. "mn" and not "meetingNumber"
$meetingData['meetingData']['userName'] = trim($USER->firstname.' '.$USER->lastname);
$meetingData['meetingData']['userEmail'] = $USER->email;
$role = isset( $meetingData['meetingData']['role'] ) ? $meetingData['meetingData']['role'] : '0';//attendee forced
$meetingData['meetingData']['sdkKey'] = $sdkKey;
$meetingData['meetingData']['signature'] = generate_signature( $sdkKey, $sdkSecret, $meetingData['meetingData']['meetingNumber'], $role);

print json_encode($meetingData);

// this function is right from the Zoom documentation
//https://marketplace.zoom.us/docs/sdk/native-sdks/auth/#generate-the-sdk-jwt
function generate_signature ( $sdkKey, $sdkSecret, $meeting_number, $role){

    //Set the timezone to UTC
    $time = time();
    $texp = $time + 60 * 60 * 2;
	
    // 2022
    $header = (object) array('alg' => 'HS256', 'typ' => 'JWT');
    $payload = (object) array(
        'sdkKey' => $sdkKey,
        'mn' => $meeting_number,
        'role' => $role,
        'iat' => $time,
        'exp' => $texp,
        'appKey' => $sdkKey,
        'tokenExp' => $texp
    );

    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header)));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $sdkSecret, true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}

?>