<?php

$_GET = [
  "name" => "pedido",
  "action" => "edit_status",
];

$_POST = [
    "idpedido" => 1,
    "cpf" => 123456789,
];


require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);