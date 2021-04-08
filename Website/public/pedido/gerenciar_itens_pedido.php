<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 1);
$response = $api->process($request);


$_GET = [ "name" => "pedido", "action" => "list_cart"];
$request2 = new Request('sync', true, 1);
$response2 = $api->process($request2);


$_GET = [ "name" => "produto", "action" => "list"];
$request3 = new Request('sync', true, 1);
$response3 = $api->process($request3);

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
<!-- Header -->
<header class="header-section">
    <?php require_once __DIR__ . "/../assets/layout/header.php"; ?>
</header>

<!-- Conteúdo da Página -->
<section class="product-filter-section">
    <div class="container">
        <div class="spad">
            <div class="cart-table">
                <h4>Seleção dos Itens do Pedido</h4>
                <div class="cart-table-warp">
                    <table id="lista_produtos" class="display">
                        <thead>
                        <tr>
                            <th>PRODUTO</th>
                            <th>PREÇO</th>
                            <th>SELECIONADO</th>
                            <th>ADICIONAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Listando
                        foreach ($response3->getData(null, true) as $registry){

                            $cart = $response2->getData(null, true);
                            $quantity = isset($cart[$registry["iditem"]]) ? $cart[$registry["iditem"]]["quantidade"] : 0;

                            echo '<form>';
                            echo '<tr>';
                            echo "<td>" . $registry['nome'] . "</td>";
                            echo "<td> R$ " . number_format($registry['preco'], 2) . "</td>";
                            echo "<td><input type='number' name='quantidade' value='{$quantity}'></td>";
                            echo '<td class="total-col">';
                            echo "<button type='submit' formmethod='post' formaction='gerenciar_itens_pedido.php?name=pedido&action=edit_cart'>";
                            echo '<img width="15px" src="/public/assets/vendor/css-datatables/images/plus.png">';
                            echo "</button> ";
                            echo '</td>';
                            echo '<td>';
                            echo "<input type='hidden' name='iditem' value='{$registry['iditem']}'>";
                            echo '</td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="/public/pedido/gerenciar_pedidos.php" class="site-btn sb-dark">VOLTAR</a>
                    <a href="/public/pedido/visualizar_pedido.php" class="site-btn sb"> AVANÇAR </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Arquivos JS -->
<?php require_once __DIR__ . "/../assets/layout/main_scripts.php"; ?>
<script src="/public/assets/js/scripts.js"></script>
<script src="/public/assets/vendor/datatables/datatables.minMain.js"> </script>
</body>
</html>
