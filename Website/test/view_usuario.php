<?php

$_GET = [
  "name" => "usuario",
  "action" => "view",
];

$_POST = [
    "idcliente" => 1,
];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);