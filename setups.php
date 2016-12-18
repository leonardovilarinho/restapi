<?php
use LegionLab\Rest\Collections\Settings;

Settings::set('api_url', 'php7.dev/restapi');

Settings::set('deployment', true);
Settings::set('logs', true);

Settings::set("dbhost", "localhost");
Settings::set("dbuser", "root");
Settings::set("dbpassword", "root");
Settings::set("default_dbname", "restapi");

ini_set('display_errors', 'On');
ini_set('display_startup_errors ', 'On');
ini_set('error_reporting', -1);
ini_set('log_errors', 'On');