# Prácticas de Mi Sitio

Resumen rápido de lo que hay en cada archivo, por si me pierdo luego 😅

---

## index.php
La página principal. Saluda con el nombre que le pases (por la URL con `?usuario=` o por el formulario) y cambia el color del título con `?color=`. Tiene botones de colores y un botoncito con Alpine JS que despliega un texto.

## practica01.php
Una mini API que responde en JSON.
- **GET**: devuelve un mensaje y la categoría que le pases (`?categoria=libros`).
- **POST**: le mandas `usuario` y `email` en JSON y te dice si se ha registrado. Si falta alguno, error 400.
- Cualquier otro método → error 405.

## UT02_P01.php y contador.php (Práctica 01)
- `UT02_P01.php` es el formulario donde escribes un número y le das a enviar.
- `contador.php` recibe ese número y lo muestra como "Contador: X", con un botón para sumarle +1 cada vez.

## UT02P02.html y UT02P02.php (Práctica 02)
Calculadora de salario. En el HTML metes el sueldo (más de 1000) y eliges el puesto. El PHP valida los datos y le suma un complemento:
- Base → 10 %
- Directivo → 15 %
- Alto cargo → 20 %

Luego enseña el sueldo base, el complemento y el sueldo final. El estilo está en `UT02P02.css`.

## UT02P03.html y UT02P03.php (Práctica 03)
Formulario con nombre, correo, edad y unos checkboxes de conocimientos (HTML, CSS, JS, PHP, Java). El PHP limpia y valida todo con `filter_input`. Si hay errores los saca en rojo, y si está todo bien muestra un resumen con lo que has puesto.

## ut03p02.html y ut03p02.php (UT03 Práctica 02)
Calculadora de longevidad. En el HTML contestas 5 preguntas (tabaco, actividad física, alcohol, altura/peso y alimentación) y eliges sexo. El PHP parte de la esperanza de vida de España según el sexo (hombre 81,4 / mujer 86,5) y le suma o resta años según cada respuesta, usando arrays donde la clave es el `value` del formulario.
- El IMC se calcula con peso / (altura en metros)² y un `foreach` busca el primer tramo que lo supera.
- Si algo no es válido avisa en rojo y ese factor no cuenta (si falta el sexo no calcula).
- Muestra la estimación, cada hábito con su barra (verde suma, rojo resta, gris no cambia) y cuál es el que más resta.
- Usa `filter_input`, `match`, `foreach` y la sintaxis alternativa `if: endif;`, todo lo de las prácticas anteriores.

## includes/
Cosas que se reutilizan en las páginas:
- `header-navigation.php`: el `<head>` con las librerías y la barra de navegación.
- `footer-info.php`: el pie de página.
- `db-connection.php`: para la base de datos, todavía vacío.

## prueba.php
Es solo para probar cosas. Ahora mismo solo tiene la estructura base que pide el profe (el HTML con Bulma, Alpine y Axios) y el `<body>` vacío, para ir probando ahí sin liarla en los demás archivos.

## Estructura base (la que pide el profe)
Todos los archivos con HTML llevan el mismo `<head>`: Bulma por CDN, Alpine JS y Axios. Por eso `plantilla.html` y `UT03.php` también la traen.
