<?php
// UT03 - Práctica 01: Tarjeta de perfil (recibe los datos de ut03p01.html)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acceso no válido. Rellena primero el <a href='ut03p01.html'>formulario</a>.");
}

$rolesValidos = ["admin", "editor", "autor", "otro"];

// Recogemos y validamos como en UT02P03
$nombre = trim(filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_SPECIAL_CHARS) ?? "");
$edad   = filter_input(INPUT_POST, "edad", FILTER_VALIDATE_INT, [
    "options" => ["min_range" => 0, "max_range" => 120]
]);
$rol    = filter_input(INPUT_POST, "rol", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

$errores = [];
if ($nombre === "")                    $errores[] = "El nombre es obligatorio.";
if ($edad === false || $edad === null) $errores[] = "La edad no es válida (0-120).";
if (!in_array($rol, $rolesValidos))    $errores[] = "Elige un rol de la lista.";

if (empty($errores)) {
    // Clase CSS del badge según el rol
    $claseBadge = match ($rol) {
        "admin"  => "bg-danger",
        "editor" => "bg-warning",
        "autor"  => "bg-info",
        default  => "bg-secondary",
    };

    // Etiqueta descriptiva según el rol
    $etiqueta = match ($rol) {
        "admin"  => "Administrador · Acceso total al panel de administración",
        "editor" => "Editor · Puede crear, editar y publicar contenido",
        "autor"  => "Autor · Puede crear y editar contenido, pero no publicar",
        default  => "Invitado · Acceso de solo lectura",
    };

    $esMayor = $edad >= 18;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UT03 - Práctica 01: Tarjeta de Perfil</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="ut03p01.css">
</head>

<body>
    <section class="section">
        <div class="container" style="max-width: 500px;">
            <h1 class="title has-text-centered">Perfil de Usuario</h1>

            <?php if (!empty($errores)): ?>
                <div class="notification is-danger is-light">
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <a class="button" href="ut03p01.html">Volver</a>

            <?php else: ?>
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <i class="fa fa-user-circle fa-3x"></i>
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4"><?= $nombre ?></p>
                                <p class="subtitle is-6">
                                    <span class="badge <?= $claseBadge ?>"><?= $etiqueta ?></span>
                                </p>
                            </div>
                        </div>

                        <div class="content">
                            <p><strong>Edad:</strong> <?= $edad ?> años</p>

                            <!-- Sintaxis alternativa condicional -->
                            <?php if ($esMayor): ?>
                                <div class="notification is-success is-light py-2 px-3">
                                    <i class="fa fa-check-circle"></i> Usuario mayor de edad (Acceso habilitado).
                                </div>
                            <?php else: ?>
                                <div class="notification is-danger is-light py-2 px-3">
                                    <i class="fa fa-times-circle"></i> Usuario menor de edad (Acceso restringido).
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <a class="button mt-4" href="ut03p01.html">Volver</a>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>
