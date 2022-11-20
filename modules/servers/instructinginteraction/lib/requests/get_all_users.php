<?php
/**
 * get_all_users.php is created by Hadesson
 *
 */
require_once ('main.php');

$base_url = InstructingConsts::$INSTRUCTING_BASE_URL;
$test_email = InstructingConsts::$INSTRUCTING_ADMIN_EMAIL;
$test_pwd = InstructingConsts::$INSTRUCTING_ADMIN_PWD;

$token = login_api_call(InstructingConsts::$INSTRUCTING_BASE_URL, InstructingConsts::$INSTRUCTING_ADMIN_EMAIL, InstructingConsts::$INSTRUCTING_ADMIN_PWD);

$users_all= get_users_api_call(InstructingConsts::$INSTRUCTING_BASE_URL, $token);
print("users" . PHP_EOL);
print(json_encode($users_all) . PHP_EOL);