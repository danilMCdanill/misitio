<?php
// Comprobamos que los datos llegan por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acceso no válido. Rellena primero el <a href='UT02P02.html'>formulario</a>.");
}

// Recogemos los datos
$sueldo = $_POST["sueldo"] ?? "";
$puesto = $_POST["puesto"] ?? "";

// Porcentaje de complemento según el puesto
$porcentajes = [
    "base"       => 10,
    "directivo"  => 15,
    "alto cargo" => 20,
];

// Validación en el servidor
$sueldoValido = filter_var($sueldo, FILTER_VALIDATE_INT) !== false && (int)$sueldo > 1000;
$puestoValido = array_key_exists($puesto, $porcentajes);

if (!$sueldoValido || !$puestoValido) {
    die("Datos incorrectos. <a href='UT02P02.html'>Volver al formulario</a>");
}

// Cálculo
$sueldo      = (int)$sueldo;
$complemento = $porcentajes[$puesto];
$sueldoFinal = $sueldo + ($sueldo * $complemento / 100);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="UT02P02.css">
</head>
<body>
    <h1>Resultado</h1>
    <p>El sueldo base es de <?= $sueldo ?>€</p>
    <p>El complemento es del <?= $complemento ?>%</p>
    <p>El sueldo final es de <?= $sueldoFinal ?>€</p>
    <p><a href="UT02P02.html">Volver</a></p>
</body>
</html>
