<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        <script src="//unpkg.com/alpinejs" defer>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <title>Ejemplo Servidor</title>
</head>

<body>
    <!-- Bloque o sentencia de guión embebido en PHP -->
    <?php
    $color = $_GET["color"];
    ?>

    <h1 style="color: <?php echo $color; ?>;">
        <?php
        $usuario = $_GET["usuario"];
        echo "Bienvenido a la web, " . $usuario;
        ?>
    </h1>

    <div x-data="{ open: false }">
        <button class="button is-warning" @click="open = true">Expand</button>

        <span x-show="open">
            Content...
        </span>
    </div>
</body>

</html>