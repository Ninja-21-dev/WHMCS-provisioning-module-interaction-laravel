<?php
/**
 * team_operation_request.php is created by Hadesson
 *
 */
require_once __DIR__ . '/main_request.php';


// API call to get all teams
function get_teams_api_call($domain_url,
                            $token)
{
    global $INSTRUCTING_URL_TEAM_MAIN_PATH, $INSTRUCTING_GET_REQUEST_METHOD;
    $connection_url = $domain_url . $INSTRUCTING_URL_TEAM_MAIN_PATH;

    // Set post values
    $postfields = array();

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $postfields, $INSTRUCTING_GET_REQUEST_METHOD);

    // Print array structure for inspection
    global $INSTRUCTING_DATA_JSON_KEY;
    print(json_encode($jsonData[$INSTRUCTING_DATA_JSON_KEY]) . PHP_EOL);

    return $jsonData[$INSTRUCTING_DATA_JSON_KEY];
}


// API call to create a new team
function create_team_api_call($domain_url,
                              $token,
                              array $params)
{
    global $INSTRUCTING_URL_TEAM_MAIN_PATH, $INSTRUCTING_POST_REQUEST_METHOD;
    $connection_url = $domain_url . $INSTRUCTING_URL_TEAM_MAIN_PATH;

    // Set post values
    $create_info = $params;

    // Set Http Request Headers
    $postheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );
 
    // Get decoded http response
    $jsonData = original_api_call($connection_url, $postheaders, $create_info, $INSTRUCTING_POST_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData;
}

// API call to update a team
function update_team_api_call($domain_url,
                              $token,
                              array $params)
{
    global $INSTRUCTING_URL_TEAM_MAIN_PATH, $INSTRUCTING_PUT_REQUEST_METHOD, $INSTRUCTING_TEAM_DB_ID;

    $connection_url = $domain_url . $INSTRUCTING_URL_TEAM_MAIN_PATH . '/' . $params[$INSTRUCTING_TEAM_DB_ID];

    // Set Updated User Info
    $update_info = $params;

    // Set Http Request Headers
    $httpheaders = array(
        'Accept:Application/json',
        'Authorization:Bearer ' . $token
    );

    // Get decoded http response
    $jsonData = original_api_call($connection_url, $httpheaders, $update_info, $INSTRUCTING_PUT_REQUEST_METHOD);

    // Print array structure for inspection
    print(json_encode($jsonData) . PHP_EOL);

    return $jsonData;
}

