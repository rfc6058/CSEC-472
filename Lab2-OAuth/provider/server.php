<?php

$dsn = 'mysql:dbname=oauth2_db;host=localhost';
$username = 'root';
$password = '';

// Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Autoloading
require_once('oauth2-server-php/src/OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

// DSN is Data Source Name for the database
$storage = new Oauth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

// Pass storage object or array to OAuth2 Server class
$server = new OAuth2\Server($storage);

// Add client creds grant type
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add auith code grant type
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

?>