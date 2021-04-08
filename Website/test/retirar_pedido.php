<?php

$_GET = [
  "name" => "pedido",
  "action" => "list_itens_pedido",
];

$_POST = [
    "idpedido" => 1,
];


require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);