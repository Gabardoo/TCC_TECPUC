<?php

require_once __DIR__ . "/../../backend/Api.php";

$_GET = [ "name" => "pedido", "action" => "list_cart"];
$request = new Request('sync', true, 1);
$response = $api->process($request);

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

<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="cart-table">
                    <h4>Seu Pedido</h4>
                    <hr>
                    <div class="cart-table-warp">
                        <table>
                            <tbody>
                            <?php
                            $valor_total = 0;
                            $data = $response->getData(null, true);
                            if(!empty($data)){
                                foreach ($data as $registry){
                                    $valor_total += (float) $registry['preco'] * $registry['quantidade'];
                                    echo '<tr>';
                                    echo '<td class= "qtde-data"><data type = "text" id = "qtde" name = "qtde" maxlength = "3" size = "2" >' . 'Quantidade ' . $registry['quantidade'] . '</data ></td >';

                                    echo '<td class="product-col" >';
                                    echo '<div class="pc-title">';
                                    echo '<span><u>Preço unitário: </u></span>';
                                    echo '<span> R$' . number_format((float)  $registry['preco'], 2, ',', '') . '</span>';
                                    echo '<p>' . $registry['nome'] . '</p></td>';
                                    echo '</td>';
                                    echo '<td class="product-col" >';
                                    echo '<div class="pc-title">';
                                    echo '<h4>R$' . number_format((float) $registry['preco'] * $registry['quantidade'], 2, ',', '') . '</h4></td>';
                                    echo '</tr>';
                                }
                            }
                            else{
                                echo '<h5>Seu pedido está vazio ou ainda não foi criado.</h5><br>Crie e gerencie os seus pedidos através do menu superior direito "Perfil", e clicando na opção "Gerenciar Pedidos".';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-cost">
                        <?php
                        if (!empty($data)){
                            echo '<h6>Valor Total: R$ ' . number_format((float) $valor_total, 2, ',', '') . '</h6>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 card-right">
                <?php
                // Se existir idpedido , exibe o botão de ir para pagamento
                if ($valor_total > 0) {
                    echo '<a href="/public/pagamento/selecao_forma_pagamento.php" class="site-btn">CONTINUAR PARA PAGAMENTO</a>';
                }
                ?>
                <a href="/public/pedido/gerenciar_itens_pedido.php" class="site-btn sb-dark">ADICIONAR MAIS</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->

<!-- Scripts -->
<?php require_once __DIR__ . "/../assets/layout/main_scripts.php"; ?>
</body>
</html>