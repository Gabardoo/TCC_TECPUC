<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync');
$response = $api->process($request);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>KeyAr</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <?php require_once __DIR__ . "/../assets/layout/index_css.php"; ?>
    <link rel='stylesheet' href='/public/assets/css/styles_novousuario2.css'>
</head>
<body>
<div class="container-login100">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-30 p-b-30 container-custom" id=formulario-cliente>
        <form class="login100-form validate-form" action="../index.php?name=usuario&action=insert"  method="post">
            <span class="login100-form-title p-b-37"> NOVO CLIENTE </span>
            <?php
                if($response->getCode() != 6){
                    echo '<div class="alert alert-warning" role="alert">';
                    echo $response->getMessage();
                    if($response->getCode() == 2){
                        echo " Invalid Fields: " . implode(", ", $response->getInvalidFields());
                    }
                    echo '</div>';
                }
            ?>
            <div class="wrap-input100 validate-input m-b-20" data-validate="nomeusuario">
                <input class="input100" type="text" name="login" placeholder="Login" value="<?php echo $response->getData('login') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="senha">
                <input class="input100" type="text" name="senha" placeholder="Senha" value="<?php echo $response->getData('senha') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="nome">
                <input class="input100" type="text" name="nome" placeholder="Nome" value="<?php echo $response->getData('nome') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="sobrenome">
                <input class="input100" type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $response->getData('sobrenome') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-25" data-validate="cpf">
                <input class="input100" type="text" name="cpf" placeholder="CPF" value="<?php echo $response->getData('cpf') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="telefone">
                <input class="input100" type="text" name="telefone" placeholder="Telefone" value="<?php echo $response->getData('telefone') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="e-mail">
                <input class="input100" type="text" name="email" placeholder="E-mail" value="<?php echo $response->getData('email') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="cep">
                <input class="input100" type="text" name="cep" placeholder="CEP" value="<?php echo $response->getData('cep') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="logradouro">
                <input class="input100" type="text" name="logradouro" placeholder="Logradouro" value="<?php echo $response->getData('logradouro') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-25" data-validate="numero">
                <input class="input100" type="text" name="numero" placeholder="Número" value="<?php echo $response->getData('numero') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-20" data-validate="complemento">
                <input class="input100" type="text" name="complemento" placeholder="Complemento" value="<?php echo $response->getData('complemento') ?>">
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn">
                <div class="text-center">
                    <button type="submit"> CRIAR CADASTRO </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<?php require_once __DIR__ . "/../assets/layout/index_scripts.php"; ?>
</body>
</html>