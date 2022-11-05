<?php
/**
 * send_request.php is created by Hadesson
 *
 */
require_once __DIR__ . '/constants/database_const.php';

function original_api_call($connection_url, $headers, $params)
{
    // Call the API
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $connection_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
    }

    curl_close($ch);

    // Return decoded response
    return json_decode($response, true);
}


//call
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

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields);


//    return json_encode($jsonData[$access_token]);
    return $jsonData[$access_token];
}


// API call to create a new user
function create_user_api_call($domain_url,
                              $token,
                              $email,
                              $name,
                              $pwd,
                              $status,
                              $roles)
{
    $connection_url = $domain_url . "/api/v1/users";

    // Set post values
    $postfields = array(
        'email' => $email,
        'name' => $name,
        'password' => $pwd,
        'status' => $status,
        'roles' => $roles,
    );
    print(json_encode($roles));

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields);

    // Print array structure for inspection
    print(json_encode($jsonData));

    return $jsonData;
}

$base_url = "https://onboardingdemo.stuffsleuth.com";
$test_email = "admin@admin.com";
$test_pwd = "password";

$token = login_api_call($base_url, $test_email, $test_pwd);
print(" this result: " . $token);

$test_user = "test_user_2";
$test_fields = array(
    $user_db_email => $test_user . "@gamil.com",
    $user_db_name => $test_user,
    $user_db_pwd => $test_user,
    $user_db_status => "status",
//    $user_db_roles => [],
    $user_db_roles => array(1),
);

create_user_api_call(
    $base_url,
    $token,
    $test_fields[$user_db_email],
    $test_fields[$user_db_name],
    $test_fields[$user_db_pwd],
    $test_fields[$user_db_status],
    $test_fields[$user_db_roles]
);
