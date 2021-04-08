<?php

$_GET = [
  "name" => "pedido",
  "action" => "edit_cart",
];

$_POST = [
    "iditem" => 1,
    "quantidade" => 1,
];


require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);