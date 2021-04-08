<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 1);
$response = $api->process($request);


$_GET = [ "name" => "pedido", "action" => "list_itens_pedido"];
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
<!-- Header -->
<header class="header-section">
    <?php require_once __DIR__ . "/../assets/layout/header.php"; ?>
</header>

<!-- Conteúdo da Página -->
<section class="product-filter-section">
    <div class="container">
        <div class="spad">
            <div class="cart-table">
                <h4>Lista de Itens do Pedido</h4>
                <div class="cart-table-warp">
                    <table id="lista_produtos" class="display">
                        <thead>
                        <tr>
                            <th>CÓDIGO<br>PRODUTO</th>
                            <th>PRODUTO</th>
                            <th>QUANTIDADE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Listando
                        foreach ($response2->getData(null, true) as $registry){
                            echo '<tr>';
                            echo "<td>" . $registry['iditem'] . "</td>";
                            echo "<td>" . $registry['nome'] . "</td>";
                            echo "<td>" . $registry['quantidade'] . "</td>";
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="/public/pedido/confirmar_retirada.php" class="site-btn sb">VOLTAR</a>
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
