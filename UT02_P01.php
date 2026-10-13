<!-- si no recibe nada, inicialmente mostrara una casilla de texto para escribir un numero y un boton
    enviar cuando el usuario haga clic en enviar aparecera en la pantalla contador: numero que escribio
    y debajo un boton para incrementar +1 -->

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
        <h1>Contador</h1>
        <form method="post" action="">
            <label for="numero">Ingrese un número:</label>
            <input type="number" id="numero" name="numero">
            <button type="submit">Enviar</button>
        </form>
    </body>

    </html>