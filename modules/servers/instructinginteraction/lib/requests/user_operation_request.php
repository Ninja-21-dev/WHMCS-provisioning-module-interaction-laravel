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
    $connection_url = $domain_url . InstructingConsts::$INSTRUCTING_URL_USER_MAIN_PATH;

    // Set post values
    $postfields = array();

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, InstructingConsts::$INSTRUCTING_GET_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData[InstructingConsts::$INSTRUCTING_DATA_JSON_KEY]) . PHP_EOL);

    return $jsonData[InstructingConsts::$INSTRUCTING_DATA_JSON_KEY];
}


// API call to create a new user
function create_user_api_call($domain_url,
                              $token,
                              array $params)
{
    $connection_url = $domain_url . InstructingConsts::$INSTRUCTING_URL_USER_MAIN_PATH;

    // Set post values
    $create_info = $params;

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $create_info, InstructingConsts::$INSTRUCTING_POST_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData[InstructingConsts::$INSTRUCTING_DATA_JSON_KEY];
}

// API call to update a user
function update_user_api_call($domain_url,
                              $token,
                              array $params)
{
    $connection_url = $domain_url . InstructingConsts::$INSTRUCTING_URL_USER_MAIN_PATH . '/' . $params[InstructingConsts::$INSTRUCTING_USER_DB_ID];

    $user_ids = array ();
//    $id_count = 0;
    foreach($params[InstructingConsts::$INSTRUCTING_USER_DB_ROLES] as $user_role){
//        $user_ids.array_push(array($user_role[InstructingConsts::$INSTRUCTING_ROLE_DB_ID]));
        $user_ids[] = $user_role[InstructingConsts::$INSTRUCTING_ROLE_DB_ID];
    }
    print(json_encode($user_ids));


    // Set Updated User Info
    $update_info = $params;
    $update_info[InstructingConsts::$INSTRUCTING_USER_DB_ROLES] = $user_ids;

    // Set Http Request Headers
    $httpheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $httpheaders, $update_info, InstructingConsts::$INSTRUCTING_PUT_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData[InstructingConsts::$INSTRUCTING_DATA_JSON_KEY];
}