<?php

require_once __DIR__ . "/../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);


$_GET = [ "name" => "usuario", "action" => "verify_auth"];
$request2 = new Request('sync');
$response2 = $api->process($request2);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>KeyAr</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Arquivos CSS -->
    <?php require_once __DIR__ . "/assets/layout/index_css.php"; ?>
</head>
<body>
<div class="container-login100">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-50 p-b-30">
        <form class="login100-form validate-form" method="post" action="?name=usuario&action=login">
            <span class="login100-form-title p-b-37">
                LOGIN
            </span>
            <?php
                if($response2->getCode() != 6 && $response2->getCode() != 6){
                    echo '<div class="alert alert-warning" role="alert">';
                    echo $response2->getMessage();
                    if($response2->getCode() == 2){
                        echo " Invalid Fields: " . implode(", ", $response2->getInvalidFields());
                    }
                    echo '</div>';
                }
            ?>
            <div class="wrap-input100 validate-input m-b-20" data-validate="login">
                <input class="input100" type="text" name="login" placeholder="Login">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-25" data-validate="senha">
                <input class="input100" type="password" name="senha" placeholder="Senha">
                <span class="focus-input100"></span>
            </div>
            <br>
            <br>
            <br>
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    LOGIN
                </button>
            </div>

            <div class="text-center p-t-57 p-b-20">
                <div class="text-center">
                    <a href="/public/cliente/novo_cliente.php">Novo Usuário? Cadastre-se! </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<?php require_once __DIR__ . "/assets/layout/index_scripts.php"; ?>
</body>
</html>