<?php

// include OAuth2 Server object

require_once __DIR__.'/server.php';

//handle request for token and send response
$server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();

?>