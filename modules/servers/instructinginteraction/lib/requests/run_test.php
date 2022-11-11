<?php
/**
 * run_test.php is created by Hadesson
 *
 */

require_once __DIR__ . '/login_request.php';
require_once __DIR__ . '/user_operation_request.php';
require_once __DIR__ . '/team_operation_request.php';

global $INSTRUCTING_BASE_URL, $INSTRUCTING_ADMIN_EMAIL, $INSTRUCTING_ADMIN_PWD;
$base_url = $INSTRUCTING_BASE_URL;
$test_email = $INSTRUCTING_ADMIN_EMAIL;
$test_pwd = $INSTRUCTING_ADMIN_PWD;

// get token
$token = login_api_call($base_url, $test_email, $test_pwd);

// mock data
$test_user = "test_user_4";
$test_fields = array(
    $INSTRUCTING_USER_DB_EMAIL => $test_user . "@gamil.com",
    $INSTRUCTING_USER_DB_NAME => $test_user,
    $INSTRUCTING_USER_DB_PWD => $test_user,
    $INSTRUCTING_USER_DB_STATUS => "status",
    $INSTRUCTING_USER_DB_ROLES => array(1, 2), //[1, 2]
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

//$user_count = count($users);
//$last_user = $users[$user_codunt - 1];
$last_user = end($users);
$last_user[$INSTRUCTING_USER_DB_STATUS] = 'updated aastatus';
//$last_user[$INSTRUCTING_USER_DB_ROLES] = array(1,2);

print("last user" . PHP_EOL);
print(json_encode($last_user) . PHP_EOL);

// user after being updated
$updated_user = update_user_api_call(
    $base_url,
    $token,
    $last_user
);

print("updated user" . PHP_EOL);
print(json_encode($updated_user) . PHP_EOL);


//all teams
$all_teams = get_teams_api_call(
    $base_url,
    $token
);

print("all teams" . PHP_EOL);
print(json_encode($all_teams) . PHP_EOL);