<?php

/**
 * UT02 - Práctica 01 (2/2): contador y suma
 * Recibe "numero" (y opcionalmente "sumar") por GET.
 * Sin número válido -> vuelve al formulario.
 */
$numero = filter_input(INPUT_GET, "numero", FILTER_VALIDATE_INT);
$sumar  = filter_input(INPUT_GET, "sumar", FILTER_VALIDATE_INT);




if (is_int($sumar)) {
    $numero += $sumar;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container" style="max-width: 420px;">
            <h1 class="title">Contador: <?= $numero ?></h1>

            <form method="get" action="contador.php" class="mb-4">
                <input type="hidden" name="numero" value="<?= $numero ?>">
                <input type="hidden" name="sumar" value="1">
                <button type="submit" class="button is-primary">Incrementar +1</button>
            </form>

        </div>
    </section>
</body>

</html>