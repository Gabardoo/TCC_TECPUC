<?php

$_GET = [
  "name" => "usuario",
  "action" => "edit",
];

$_POST = [
    "senha" => "",
    "telefone" => "1111",
    "email" => "1111",
    "cep" => "1111",
    "logradouro" => "1111",
    "numero" => "1111",
    "complemento" => "1111",
];

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);