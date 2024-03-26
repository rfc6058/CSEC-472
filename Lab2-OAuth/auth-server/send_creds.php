<?php
// Requires Halite and Libsodium for crypto operations

use ParagonIE\Halite\KeyFactory;
use ParagonIE\Halite\Symmetric\Crypto as Crypto;
use ParagonIE\HiddenString\HiddenString;

$encKey = KeyFactory::generateEncryptionKey();
KeyFactory::save($encKey, '../auth-keys/auth-server.key');

$encryptionKey = KeyFactory::loadEncryptionKey('../auth-keys/auth-server.key');

$ip = "localhost";
$port = '8443';

$provider = "http://$ip:$port/authorize.php";

// Make HTTP request to oauth provider with recieved credentials from client

$message = new HiddenString(json_encode(array("username" => "user", "password" => "pass")));
$enc_message = Crypto::encrypt($message, $encryptionKey);
// send message to provider

// Recieve HTTP response from oauth provider encrypted with pre-shared key, use key to decrypt response, use AES-256-CBC encryption
/* Response format (JSON):
    {"auth":"success/fail", "token":"12345678"}


*/
$response = ""; // AES encrypted

// Decrypt response
$pt_response = Crypto::decrypt($response, $encryptionKey)->getString();
$pt_response = json_decode($pt_response, true);

// if response doesn't have a token/bad creds
if (strpos($response, 'token') == false) {
    $response = json_encode(array("auth" => "fail", "token" => ""));
}
// else hits iff response has a token/good creds
else {
    $token = $response["token"];
    $success = array("auth" => "success", "token" => "1234567890");
    $response = json_encode($success);
}





// 



?>