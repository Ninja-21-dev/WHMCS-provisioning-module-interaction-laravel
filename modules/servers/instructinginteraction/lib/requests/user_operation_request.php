<?php
/**
 * user_operation_request.php is created by Hadesson
 *
 */

require_once __DIR__ . '/main_request.php';


// API call to get all users
function get_users_api_call($domain_url,
                            $token)
{
    global $GET_REQUEST_METHOD, $URL_USER_MAIN_PATH;
    $connection_url = $domain_url . $URL_USER_MAIN_PATH;

    // Set post values
    $postfields = array();

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, $GET_REQUEST_METHOD);

    // Print array structure for inspection
    global $DATA_JSON_KEY;
    print(json_encode($jsonData[$DATA_JSON_KEY]) . PHP_EOL);

    return $jsonData[$DATA_JSON_KEY];
}


// API call to create a new user
function create_user_api_call($domain_url,
                              $token,
                              array $params)
{
    global $URL_USER_MAIN_PATH;
    $connection_url = $domain_url . $URL_USER_MAIN_PATH;

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

// API call to update a user
function update_user_api_call($domain_url,
                              $token,
                              array $params)
{
    global $URL_USER_MAIN_PATH, $USER_DB_ID, $USER_DB_ROLES, $ROLE_DB_ID;
    $connection_url = $domain_url . $URL_USER_MAIN_PATH . '/' . $params[$USER_DB_ID];

    $user_ids = array ();
//    $id_count = 0;
    foreach($params[$USER_DB_ROLES] as $user_role){
//        $user_ids.array_push(array($user_role[$ROLE_DB_ID]));
        $user_ids[] = $user_role[$ROLE_DB_ID];
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