<?php

$_GET = [
  "name" => "usuario",
  "action" => "insert",
];

$_POST = [
    "login" => "111111",
    "senha" => "1111",
    "nome" => "1111",
    "sobrenome" => "1111",
    "cpf" => "1111",
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