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
    <!-- Bloque o sentencia de guión embebido en PHP -->
    <?php
    $color = $_GET["color"] ?? "navbar";
    ?>

    <h1 style="color: <?php echo $color; ?>;">
        <?php
        $usuario = $_POST["usuario"] ?? $_GET["usuario"] ?? "Invitado"; // http://misitio.test/index.php?color=green&usuario=JoseAntonio
        echo "Bienvenido a la web, " . htmlspecialchars($usuario);
        ?>
    </h1>

    <div x-data="{ open: false }">
        <button class="button is-warning" @click="open = true">Expand</button>

        <span x-show="open">
            Content...
        </span>
    </div>

    <div class="buttons">
        <a href="index.php?color=blue" class="button is-info">AZUL</a>
        <a href="index.php?color=green" class="button is-success">VERDE</a>
        <a href="index.php?color=yellow" class="button is-warning">AMARILLO</a>
        <a href="index.php?color=red" class="button is-danger">ROJO</a>
    </div>

    <form name="myform" method="POST" action="index.php">
        Escribe tu nombre
        <input
            class="input is-link"
            type="text"
            name="usuario"
            placeholder="ApruebameJoaquinPorDios" />
        <input type="submit" class="submit" value="ENVIAR" />
    </form>

</body>

</html>