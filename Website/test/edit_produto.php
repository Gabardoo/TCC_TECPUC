<?php

$_GET = [
  "name" => "produto",
  "action" => "edit",
];

$_POST = [
    "iditem" => 1,
    "nome" => "Coxinha",
    "preco" => "4.00",
    "modificador" => "20",
    "idcategoria" => "1",
];


require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);