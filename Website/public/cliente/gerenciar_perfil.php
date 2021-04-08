<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 1);
$response = $api->process($request);


$_GET = [ "name" => "usuario", "action" => "view"];
$request2 = new Request('sync', true, 1);
$response2 = $api->process($request2);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>KeyAr</title>
    <meta charset="UTF-8">
    <meta name="description" content=" Divisima | eCommerce Template">
    <meta name="keywords" content="divisima, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheets -->
    <?php require_once __DIR__ . "/../assets/layout/main_css.php"; ?>
    <link rel='stylesheet' href='/public/assets/css/styles_editarperfil.css'>
</head>
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Header -->
<header class="header-section">
    <?php require_once __DIR__ . "/../assets/layout/header.php"; ?>
</header>
<section class="checkout-section">
    <div class="container">
        <div class="tamanho">
            <div class="spad">
                <div class="cart-table">
                    <h4 class="mb-3">GERENCIAR PERFIL</h4>
                    <?php
                    if($response->getCode() != 6 && (!isset($_GET["action"]) || $_GET["action"] != 'view')){
                        echo '<div class="alert alert-warning" role="alert">';
                        echo $response->getMessage();
                        if($response->getCode() == 2){
                            echo " Invalid Fields: " . implode(", ", $response->getInvalidFields());
                        }
                        echo '</div>';
                    }
                    ?>
                    <form method="post" action="?name=usuario&action=edit">
                        <div class="row">
                            <div class="col">
                                <label>E-mail
                                    <input type="text" name="email" class="form-control" value="<?php echo $response2->getData('email') ?>">
                                </label>
                            </div>
                            <div class="col">
                                <label>Senha
                                    <input type="password" name="senha" class="form-control" value="">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Telefone
                                    <input type="text" name="telefone" class="form-control" value="<?php echo $response2->getData('telefone') ?>">
                                </label>
                            </div>
                            <div class="col">
                                <label>CEP
                                    <input type="text" name="cep" class="form-control" value="<?php echo $response2->getData('cep') ?>">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Logradouro
                                    <input type="text" name="logradouro" class="form-control" value="<?php echo $response2->getData('logradouro') ?>">
                                </label>
                            </div>
                            <div class="col">
                                <label>Número
                                    <input type="text" name="numero" class="form-control" value="<?php echo $response2->getData('numero') ?>">
                                </label>
                            </div>
                            <div class="col">
                                <label>Complemento
                                    <input type="text" name="complemento" class="form-control" value="<?php echo $response2->getData('complemento') ?>">
                                </label>
                            </div>
                        </div>
                        <button type="submit"class="site-btn">ALTERAR CADASTRO</button>
                        <a href="/public/main.php" class="site-btn sb-dark">VOLTAR</a>
                        <button type="button" class="site-btn botao-vermelho" data-toggle="modal" data-target="#modal-exclusao">EXCLUIR CADASTRO</button>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-exclusao" tabindex="-1" role="dialog" aria-labelledby="modal-exclusao" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Cadastro</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que deseja excluir o seu cadastro?<br>
                                        Esta ação não poderá ser desfeita!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" formaction="?acao=excluirCliente" class="btn btn-primary botao-vermelho">Excluir Cadastro</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<?php require_once __DIR__ . "/../assets/layout/main_scripts.php"; ?>

</body>
</html>
