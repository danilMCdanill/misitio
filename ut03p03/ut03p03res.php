<?php

include "datos.php";




$categoria = filter_input(INPUT_GET, "categoria", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$precioMin = filter_input(INPUT_GET, "precio_min", FILTER_VALIDATE_FLOAT);
$precioMax = filter_input(INPUT_GET, "precio_max", FILTER_VALIDATE_FLOAT);
$soloStock = filter_input(INPUT_GET, "solo_stock") === "1";


if ($precioMin === false) $precioMin = null;
if ($precioMax === false) $precioMax = null;


$resultados = [];
foreach ($productos as $producto) {
    // Si hay categoría elegida y no coincide, saltamos al siguiente
    if ($categoria !== "" && $producto["categoria"] !== $categoria) continue;
    // Si hay precio mínimo y el producto es más barato, lo saltamos
    if ($precioMin !== null && $producto["precio"] < $precioMin) continue;
    // Si hay precio máximo y el producto es más caro, lo saltamos
    if ($precioMax !== null && $producto["precio"] > $precioMax) continue;
    // Si pide solo con stock y no queda, lo saltamos
    if ($soloStock && $producto["stock"] <= 0) continue;

    $resultados[] = $producto;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Productos</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <section class="section">
        <div class="container" style="max-width: 900px;">
            <div class="level">
                <div class="level-left">
                    <h1 class="title">
                        <i class="fa fa-boxes"></i> Resultados de Productos
                    </h1>
                </div>
                <div class="level-right">
                    <a href="ut03p03.php" class="button is-light">
                        <i class="fa fa-arrow-left mr-2"></i> Nueva Búsqueda
                    </a>
                </div>
            </div>

            <!-- Resumen de Filtros Aplicados -->
            <div class="notification is-info is-light">
                <p><strong>Filtros aplicados:</strong></p>
                <ul>
                    <li>Categoría: <strong><?= $categoria !== "" ? $categoria : "Todas" ?></strong></li>
                    <li>Rango de precio:
                        <strong>
                            <?= $precioMin !== null ? number_format($precioMin, 2, ",", ".") . " €" : "Mínimo" ?>
                            -
                            <?= $precioMax !== null ? number_format($precioMax, 2, ",", ".") . " €" : "Máximo" ?>
                        </strong>
                    </li>
                    <li>Disponibilidad: <strong><?= $soloStock ? "Solo con stock" : "Todos" ?></strong></li>
                </ul>
            </div>

            <!-- Tabla de Resultados -->
            <?php if (empty($resultados)): ?>
                <div class="notification is-warning">
                    <i class="fa fa-exclamation-triangle"></i> No se encontraron productos que cumplan con los criterios seleccionados.
                </div>
            <?php else: ?>
                <div class="box">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th class="has-text-right">Precio</th>
                                <th class="has-text-centered">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $producto): ?>
                                <tr>
                                    <td><strong><?= $producto["nombre"] ?></strong></td>
                                    <td><span class="tag is-link is-light"><?= $producto["categoria"] ?></span></td>
                                    <td class="has-text-right"><?= number_format($producto["precio"], 2, ",", ".") ?> €</td>
                                    <td class="has-text-centered">
                                        <?php if ($producto["stock"] > 0): ?>
                                            <span class="tag is-success"><?= $producto["stock"] ?> uds.</span>
                                        <?php else: ?>
                                            <span class="tag is-danger">Agotado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total encontrados: <?= count($resultados) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </section>
</body>

</html>