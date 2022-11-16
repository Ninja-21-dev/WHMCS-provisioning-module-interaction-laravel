<?php
/**
 * api_const.php is created by Hadesson
 *
 */
class InstructingConsts
{
    // Basic Constants
    static $INSTRUCTING_BASE_URL = "https://onboardingdemo.stuffsleuth.com";
    static $INSTRUCTING_ADMIN_EMAIL = "admin@admin.com";
    static $INSTRUCTING_ADMIN_PWD = "password";


    // Request Method Type Name
    static $INSTRUCTING_GET_REQUEST_METHOD = "get request";
    static $INSTRUCTING_POST_REQUEST_METHOD = "post request";
    static $INSTRUCTING_PUT_REQUEST_METHOD = "put request";

    // User Info Table field names
    static $INSTRUCTING_USER_DB_EMAIL = "email";
    static $INSTRUCTING_USER_DB_ID = "id";
    static $INSTRUCTING_USER_DB_NAME = "name";
    static $INSTRUCTING_USER_DB_PWD = "password";
    static $INSTRUCTING_USER_DB_STATUS = "status";
    static $INSTRUCTING_USER_DB_ROLES = "roles";

    // Role Info
    static $INSTRUCTING_ROLE_DB_ID = "id";
    static $INSTRUCTING_ROLE_DB_TITLE = "title";
    static $INSTRUCTING_ROLE_DB_PIVOT = "pivot";


    // Team Info Table field names
    static $INSTRUCTING_TEAM_DB_ID = "id";
    static $INSTRUCTING_TEAM_DB_STATUS = "status";
    static $INSTRUCTING_TEAM_DB_NAME = "name";
    static $INSTRUCTING_TEAM_DB_OWNER_ID = "owner_id";
    static $INSTRUCTING_TEAM_DB_OWNER = "owner";

    static $INSTRUCTING_URL_USER_MAIN_PATH = "/api/v1/users";
    static $INSTRUCTING_URL_TEAM_MAIN_PATH = "/api/v1/teams";

    static $INSTRUCTING_DATA_JSON_KEY = "data";

    static $INSTRUCTING_STATUS_ACTIVE = "active";
    static $INSTRUCTING_STATUS_INACTIVE = "inactive";
}