<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acceso no válido. Rellena primero el <a href='formulario.html'>formulario</a>.");
}

$nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_SPECIAL_CHARS);

$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

$edad = filter_input(INPUT_POST, "edad", FILTER_VALIDATE_INT, [
    "options" => ["min_range" => 0, "max_range" => 120]
]);

$conocimientos = filter_input(INPUT_POST, "conocimientos", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY) ?? [];

// Validación
$errores = [];
if (empty($nombre))   $errores[] = "El nombre es obligatorio.";
if ($email === false || $email === null) $errores[] = "El correo no es válido.";
if ($edad === false || $edad === null)   $errores[] = "La edad no es válida.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel ="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <section class="section">
        <div class="container">

            <?php if (!empty($errores)): ?>
                <div class="notification is-danger">
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <a class="button" href="formulario.html">Volver</a>

            <?php else: ?>
                <div class="box">
                    Hola, <?= $nombre ?>. Tu edad es <?= $edad ?> y tu correo es
                    <strong><?= htmlspecialchars($email) ?></strong>.
                    Tienes conocimientos en:
                    <?php if (empty($conocimientos)): ?>
                        <p><em>Ninguno seleccionado.</em></p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($conocimientos as $conocimiento): ?>
                                <li><?= $conocimiento ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</body>

</html>