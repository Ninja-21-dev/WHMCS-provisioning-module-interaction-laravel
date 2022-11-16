<?php
/**
 * login_request.php is created by Hadesson
 *
 */
require_once __DIR__ . '/main_request.php';


// API call to login the site
function login_api_call($domain_url,
                        $email,
                        $pwd)
{
    $access_token = "access_token";

    // API Connection Details
    $connection_url = $domain_url . "/api/login";

    // Set post values
    $postfields = array(
        'email' => $email,
        'password' => $pwd,
    );

    // Set Http Request Headers
    $postheaders = array(
        'Accept: Application/json'
    );

//    global $INSTRUCTING_POST_REQUEST_METHOD;
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, InstructingConsts::$INSTRUCTING_POST_REQUEST_METHOD);

    print(" this result: " . $jsonData[$access_token] . PHP_EOL);
    return $jsonData[$access_token];
}
