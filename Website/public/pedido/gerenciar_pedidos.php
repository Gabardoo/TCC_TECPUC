<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 1);
$response = $api->process($request);


$_GET = [ "name" => "pedido", "action" => "list"];
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

<!-- checkout section  -->
<section class="checkout-section">
    <div class="container">
        <div class="spad">
            <div class="cart-table">
                <h4>Gerenciamento De Pedidos</h4>
                <div class="cart-table-warp">
                    <table id="lista_produtos" class="display">
                        <thead>
                        <tr>
                            <th>NUMERO DO PEDIDO</th>
                            <th>VALOR TOTAL</th>
                            <th>STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Listando
                        foreach ($response2->getData(null, true) as $registry){
                            echo '<form method="post">';
                            echo '<tr>';
                            echo "<td>" . $registry['idpedido'] . "</td>";
                            echo "<td> R$ " . number_format($registry['valor_total'], 2) . "</td>";
                            echo "<td>" . $registry['status_pedido'] . "</td>";
                            echo '</tr>';
                            echo '</form>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="/public/pedido/gerenciar_itens_pedido.php?name=produto&action=list" class="site-btn">NOVO PEDIDO</a>
                    <a href="/public/main.php" class="site-btn sb-dark">VOLTAR</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<?php require_once __DIR__ . "/../assets/layout/main_scripts.php"; ?>
<script src="/public/assets/js/scripts.js"></script>
<script src="/public/assets/vendor/datatables/datatables.minPagamento.js"> </script>
</body>
</html>