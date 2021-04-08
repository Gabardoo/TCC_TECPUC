<?php

require_once __DIR__ . "/../../backend/Api.php";

$request = new Request('sync', true, 2);
$response = $api->process($request);


$_GET = [ "name" => "produto", "action" => "list"];
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
<!-- Header -->
<header class="header-section">
    <?php require_once __DIR__ . "/../assets/layout/header.php"; ?>
</header>

<!-- Conteúdo da Página -->
<section class="product-filter-section">
    <div class="container">
        <div class="spad">
            <div class="cart-table">
                <form>
                    <table id="lista_produtos" class="display">
                        <thead>
                        <tr>
                            <th>PRODUTO</th>
                            <th>QUANTIDADE<br>ESTOQUE</th>
                            <th>PREÇO</th>
                            <th>EDITAR</th>
                            <th>EXCLUIR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Listando
                        foreach ($response2->getData(null, true) as $registry){
                            echo '<form method="post">';
                            echo '<tr>';
                            echo "<td>" . $registry['nome'] . "</td>";
                            echo "<td>" . $registry['quantidade'] . "</td>";
                            echo "<td> R$ " . number_format($registry['preco'], 2) . "</td>";
                            echo '<td class="total-col">';
                            echo "<button type='submit' formmethod='post' formaction='editar_item.php'>";
                            echo '<img width="24px" src="/public/assets/vendor/css-datatables/images/editar.png">';
                            echo "</button> ";
                            echo '</td>';
                            echo '<td class="total-col">';
                            echo "<button type='submit' formmethod='post' formaction='?name=produto&action=delete'>";
                            echo '<img width="24px" src="/public/assets/vendor/css-datatables/images/delete1.png">';
                            echo "</button>";
                            echo '<td>';
                            echo "<input type='hidden' name='iditem' value='{$registry['iditem']}'>";
                            echo '</td>';
                            echo '</form>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    <a href="/public/produto/cadastro_item.php" class="site-btn submit-order-btn">NOVO PRODUTO</a>
                    <a href="/public/main.php" class="site-btn sb-dark">VOLTAR</a>
                </form>
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