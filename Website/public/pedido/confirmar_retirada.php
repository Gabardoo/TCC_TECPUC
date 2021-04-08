<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 2);
$response = $api->process($request);


$_GET = [ "name" => "pedido", "action" => "list_by_status"];
$request2 = new Request('sync', true, 2);
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
                <h3>Confirmar Retirada de Pedidos</h3>
                <div class="cart-table-warp">
                    <table id="lista_produtos" class="display">
                        <thead>
                        <tr>
                            <th>NÚMERO DO PEDIDO</th>
                            <th>CPF DO CLIENTE</th>
                            <th>AÇÃO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Listando
                        foreach ($response2->getData(null, true) as $registry){
                            echo '<tr>';
                            echo '<form method="post" action="gerenciar_itens_pedido_retirada.php?name=pedido&action=edit_status">';
                            echo '<td>' . $registry['idpedido'] . '</td>';
                            echo '<td><input style="width:130px" type="text" name="cpf"></td>';
                            echo '<td class="total-col"><button type="submit">Confirmar Retirada</button></td>';
                            echo "<input type='hidden' name='idpedido' value='{$registry['idpedido']}'>";
                            echo '</form>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="/public/main.php" class="site-btn">VOLTAR</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<?php require_once __DIR__ . "/../assets/layout/main_scripts.php"; ?>
<script src="/public/assets/js/scripts.js"></script>
<script src="/public/assets/vendor/datatables/datatables.minMain.js"> </script>
</body>
</html>
