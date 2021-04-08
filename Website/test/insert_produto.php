<?php

$_GET = [
  "name" => "produto",
  "action" => "insert",
];

$_POST = [
    "nome" => "Coxinha",
    "preco" => "3.00",
    "quantidade" => "100",
    "idcategoria" => "1",
];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);