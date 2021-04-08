<?php

$_GET = [
  "name" => "produto",
  "action" => "view",
];

$_POST = [
    "iditem" => '1'
];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);