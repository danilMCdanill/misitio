<!-- si no recibe nada, inicialmente mostrara una casilla de texto para escribir un numero y un boton
    enviar cuando el usuario haga clic en enviar aparecera en la pantalla contador: numero que escribio
    y debajo un boton para incrementar +1 -->

<doctype html>
    <html>

    <head>
        <title>Contador</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
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