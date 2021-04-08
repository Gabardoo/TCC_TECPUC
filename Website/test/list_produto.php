<?php

$_GET = [
  "name" => "produto",
  "action" => "list",
];

$_POST = [

];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);