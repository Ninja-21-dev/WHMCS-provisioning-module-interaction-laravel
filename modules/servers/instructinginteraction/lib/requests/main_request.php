<?php
/**
 * main_request.php is created by Hadesson
 *
 */
require_once __DIR__ . '/constants/api_const.php';

function original_api_call($connection_url, $headers, $params, $request_method_type)
{
    global $POST_REQUEST_METHOD, $GET_REQUEST_METHOD, $PUT_REQUEST_METHOD;
    // Call the API
    $ch = curl_init();

    if($request_method_type == $GET_REQUEST_METHOD)
    {
        curl_setopt($ch, CURLOPT_URL, $connection_url . '?' . http_build_query($params));
    }
    else if($request_method_type == $POST_REQUEST_METHOD)
    {
        curl_setopt($ch, CURLOPT_URL, $connection_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }
    else if($request_method_type == $PUT_REQUEST_METHOD)
    {
        curl_setopt($ch, CURLOPT_URL, $connection_url);
//        curl_setopt($ch, CURLOPT_PUT, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

    }
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
    }

    curl_close($ch);

    // Return decoded response
    return json_decode($response, true);
}



