<?php
$tituloPagina = "Inicio | Mi Sitio";

// Parámetros recibidos por la URL (con valor por defecto y escapados)
$color   = htmlspecialchars($_GET["color"] ?? "black");
$usuario = htmlspecialchars($_GET["usuario"] ?? "visitante");

// Colores disponibles: valor CSS => [texto del botón, clase Bulma]
$colores = [
    "green"       => ["Verde",       "is-primary"],
    "deepskyblue" => ["Azul",        "is-info"],
    "blue"        => ["Azul Oscuro", "is-link"],
    "orange"      => ["Naranja",     "is-warning"],
    "red"         => ["Rojo",        "is-danger"],
];

include "includes/header-navigation.php";
?>

<h2 class="title">Saludo</h2>

<!-- Saludo dinámico con el color y el usuario recibidos por GET -->
<h1 class="is-size-3 mb-4" style="color: <?= $color ?>;">
    Hola <?= $usuario ?>, bienvenido a la web
</h1>

<!-- Ejemplo Alpine JS: mostrar / ocultar contenido -->
<div x-data="{ abierto: false }" class="mb-4">
    <button class="button is-warning" @click="abierto = !abierto">
        <span x-text="abierto ? 'Ocultar' : 'Mostrar'"></span>
    </button>
    <span x-show="abierto" class="ml-3">Contenido oculto...</span>
</div>

<!-- Botones de colores: cambian el color del saludo manteniendo el usuario -->
<div class="buttons mt-4">
    <?php foreach ($colores as $valor => [$texto, $clase]): ?>
        <a class="button <?= $clase ?> is-medium" href="?color=<?= $valor ?>&usuario=<?= urlencode($usuario) ?>"><?= $texto ?></a>
    <?php endforeach; ?>
</div>

<!-- Formulario: envía el nombre por GET al mismo index.php conservando el color -->
<form method="get" action="index.php" class="box" style="max-width: 420px;">
    <input type="hidden" name="color" value="<?= $color ?>">
    <div class="field">
        <label class="label" for="usuario">Escribe tu nombre:</label>
        <div class="control has-icons-left">
            <input class="input is-link" type="text" id="usuario" name="usuario" placeholder="Tu nombre">
            <span class="icon is-left"><i class="fa fa-user"></i></span>
        </div>
    </div>
    <button type="submit" class="button is-link">Enviar</button>
</form>

<?php include "includes/footer-info.php"; ?>
