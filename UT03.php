<?php
$rol = $_POST['rol'] ?? 'usuario';
$mensaje = match ($rol) {
    'admin' => 'Acceso total al panel de administración.',
    'editor' => 'Acceso a crear, editar y publicar contenido.',
    'autor' => 'Acceso a crear y editar contenido, pero no publicar.',
    default => 'Acceso de solo lectura (usuario invitado).',
};
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <section class="section">
        <div class="container">
            <?= $mensaje ?>
        </div>
    </section>

</body>

</html>