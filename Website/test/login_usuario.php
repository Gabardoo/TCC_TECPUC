<?php

$_GET = [
  "name" => "usuario",
  "action" => "login",
];

$_POST = [
    "login" => "admin",
    "senha" => "1234",
];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);