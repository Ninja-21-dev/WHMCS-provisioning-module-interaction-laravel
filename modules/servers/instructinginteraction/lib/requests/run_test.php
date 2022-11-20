<?php
/**
 * run_test.php is created by Hadesson
 *
 */

require_once __DIR__ . '/login_request.php';
require_once __DIR__ . '/user_operation_request.php';
require_once __DIR__ . '/team_operation_request.php';
require_once __DIR__ . '/generate_password.php';

$base_url = InstructingConsts::$INSTRUCTING_BASE_URL;
$test_email = InstructingConsts::$INSTRUCTING_ADMIN_EMAIL;
$test_pwd = InstructingConsts::$INSTRUCTING_ADMIN_PWD;

// get token
//$token = login_api_call($base_url, $test_email, $test_pwd);
//
//// mock data
//$test_user = "test_user_4";
//$test_fields = array(
//    InstructingConsts::$INSTRUCTING_USER_DB_EMAIL => $test_user . "@gamil.com",
//    InstructingConsts::$INSTRUCTING_USER_DB_NAME => $test_user,
//    InstructingConsts::$INSTRUCTING_USER_DB_PWD => $test_user,
//    InstructingConsts::$INSTRUCTING_USER_DB_STATUS => "status",
//    InstructingConsts::$INSTRUCTING_USER_DB_ROLES => array(1, 2), //[1, 2]
//);
//
//$new_user = create_user_api_call(
//    $base_url,
//    $token,
//    $test_fields
//);
//
//$users = get_users_api_call(
//    $base_url,
//    $token
//);
//
////$user_count = count($users);
////$last_user = $users[$user_codunt - 1];
//$last_user = end($users);
//$last_user[InstructingConsts::$INSTRUCTING_USER_DB_STATUS] = 'updated aastatus';
////$last_user[$INSTRUCTING_USER_DB_ROLES] = array(1,2);
//
//print("last user" . PHP_EOL);
//print(json_encode($last_user) . PHP_EOL);
//
//// user after being updated
//$updated_user = update_user_api_call(
//    $base_url,
//    $token,
//    $last_user
//);
//
//print("updated user" . PHP_EOL);
//print(json_encode($updated_user) . PHP_EOL);
//
//
////all teams
//$all_teams = get_teams_api_call(
//    $base_url,
//    $token
//);
//
//print("all teams" . PHP_EOL);
//print(json_encode($all_teams) . PHP_EOL);

$token = login_api_call(InstructingConsts::$INSTRUCTING_BASE_URL, InstructingConsts::$INSTRUCTING_ADMIN_EMAIL, InstructingConsts::$INSTRUCTING_ADMIN_PWD);
print("token" . PHP_EOL);
print(json_encode($token) . PHP_EOL);


$user_email = "real.testuser42@gmail.com";
$user_str = explode('@', $user_email);
$user_name = "real test";
$user_pwd = randomPassword();
$user_params = array(
    InstructingConsts::$INSTRUCTING_USER_DB_EMAIL => $user_email,
    InstructingConsts::$INSTRUCTING_USER_DB_NAME => $user_name,
    InstructingConsts::$INSTRUCTING_USER_DB_PWD => $user_pwd,
    InstructingConsts::$INSTRUCTING_USER_DB_STATUS => InstructingConsts::$INSTRUCTING_STATUS_ACTIVE,
    InstructingConsts::$INSTRUCTING_USER_DB_ROLES => array(1, 2), //[1, 2]
);
//
$user_created = create_user_api_call(InstructingConsts::$INSTRUCTING_BASE_URL, $token, $user_params);
print("user" . PHP_EOL);
print(json_encode($user_created) . PHP_EOL);
//logModuleCall(
//    'instructinginteraction',
//    __FUNCTION__,
//    $params,
//    "Create an user when service is created",
//    "Create an user"
//);
//
$team_params = array(
    InstructingConsts::$INSTRUCTING_TEAM_DB_OWNER_ID => $user_created[InstructingConsts::$INSTRUCTING_USER_DB_ID],
    InstructingConsts::$INSTRUCTING_TEAM_DB_OWNER => $user_created[InstructingConsts::$INSTRUCTING_USER_DB_NAME],
    InstructingConsts::$INSTRUCTING_TEAM_DB_STATUS => InstructingConsts::$INSTRUCTING_STATUS_ACTIVE,
    InstructingConsts::$INSTRUCTING_TEAM_DB_NAME => "domain"
);
//
$res = create_team_api_call(InstructingConsts::$INSTRUCTING_BASE_URL, $token, $team_params);
print("team" . PHP_EOL);

print(json_encode($res) . PHP_EOL);
//logModuleCall(
//    'instructinginteraction',
//    __FUNCTION__,
//    $params,
//    "Create a team when service is created",
//    "Create a team"
//);