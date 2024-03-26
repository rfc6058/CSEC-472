<?php

require_once __DIR__.'/server.php';

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

// validate authorize request

if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}

// display auth form
if (empty($_POST)) {
    exit('
    <form method="post">
      <label>Do You Authorize TestClient?</label><br />
      <input type="submit" name="authorized" value="yes">
      <input type="submit" name="authorized" value="no">
    </form>');
}

$is_authorized = ($_POST['authorized'] === 'yes');
$server->handleAuthorizeRequest($request, $response, $is_authorized);
/*
// Code to print auth code for debugging
if ($is_authorized) {
    $auth_code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40
    echo "SUCCESS: Auth code: $auth_code";
}
*/

$response->send();

?>