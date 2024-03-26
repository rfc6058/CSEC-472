<?php

// include OAuth2 Server object

require_once('server.php');

//handle request for token and send response
$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();

?>