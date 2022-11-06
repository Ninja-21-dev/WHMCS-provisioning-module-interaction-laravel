<?php
/**
 * send_request.php is created by Hadesson
 *
 */
require_once __DIR__ . '/constants/api_const.php';
//require_once __DIR__ . '/constants/request_const.php';

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

    global $POST_REQUEST_METHOD;
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, $POST_REQUEST_METHOD);

    print(" this result: " . $jsonData[$access_token] . PHP_EOL);
    return $jsonData[$access_token];
}


// API call to create a new user
function create_user_api_call($domain_url,
                              $token,
                              array $params)
{
    $connection_url = $domain_url . "/api/v1/users";

    // Set post values
    $create_info = $params;

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    global $POST_REQUEST_METHOD;
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $create_info, $POST_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData;
}

// API call to update a new user
function update_user_api_call($domain_url,
                              $token,
                              array $params)
{
    global $USER_DB_ID, $USER_DB_ROLES, $ROLE_DB_ID;
    $connection_url = $domain_url . "/api/v1/users" . '/' . $params[$USER_DB_ID];

    $user_ids = array ();
    $id_count = 0;
    foreach($params[$USER_DB_ROLES] as $user_role){
        $user_ids[ $id_count++ ] = $user_role[$ROLE_DB_ID];
    }
    print(json_encode($user_ids));


    // Set Updated User Info
    $update_info = $params;
    $update_info[$USER_DB_ROLES] = $user_ids;

    // Set Http Request Headers
    $httpheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    global $PUT_REQUEST_METHOD;
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $httpheaders, $update_info, $PUT_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData;
}

// API call to get all users
function get_users_api_call($domain_url,
                            $token)
{
    $connection_url = $domain_url . "/api/v1/users";

    // Set post values
    $postfields = array();

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    global $GET_REQUEST_METHOD;
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, $GET_REQUEST_METHOD);

    // Print array structure for inspection
    global $DATA_JSON_KEY;
    print(json_encode($jsonData[$DATA_JSON_KEY]) . PHP_EOL);

    return $jsonData[$DATA_JSON_KEY];
}



global $BASE_URL, $ADMIN_EMAIL, $ADMIN_PWD;
$base_url = $BASE_URL;
$test_email = $ADMIN_EMAIL;
$test_pwd = $ADMIN_PWD;

// get token
$token = login_api_call($base_url, $test_email, $test_pwd);

// mock data
$test_user = "test_user_4";
$test_fields = array(
    $USER_DB_EMAIL => $test_user . "@gamil.com",
    $USER_DB_NAME => $test_user,
    $USER_DB_PWD => $test_user,
    $USER_DB_STATUS => "status",
    $USER_DB_ROLES => array(1), //[1]
);

$new_user = create_user_api_call(
    $base_url,
    $token,
    $test_fields
);

$users = get_users_api_call(
    $base_url,
    $token
);

$user_count = count($users);
$last_user = $users[$user_count - 1];
$last_user[$USER_DB_STATUS] = 'updated status';

print("last user" . PHP_EOL);
print(json_encode($last_user) . PHP_EOL);


$updated_user = update_user_api_call(
    $base_url,
    $token,
    $last_user
);

print("updated user" . PHP_EOL);
print(json_encode($updated_user) . PHP_EOL);