<?php
// UT03 - Práctica 02: Calculadora de longevidad (recibe los datos de ut03p02.html)
// Autor: Daniel Martínez Abellán

// Si entran sin pasar por el formulario, los mandamos de vuelta (igual que en ut03p01.php)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acceso no válido. Rellena primero el <a href='ut03p02.html'>formulario</a>.");
}

/** Esperanza de vida al nacer en España por sexo. */
const ESPERANZA_BASE = [
    'hombre' => ['Hombre', 81.4],
    'mujer'  => ['Mujer', 86.5],
];

// Años que suma o resta cada respuesta. La clave es el "value" del radio del formulario.
$fumador = [
    'nunca'      => 0.0,
    'ex_antes'   => -1.0,
    'ex_despues' => -3.0,
    'actual'     => -10.0,
];

$ejercicio = [
    'nada'  => -1.8,
    'poco'  => 0.0,
    'oms'   => 1.6,
    'mucho' => 2.7,
];

$alcohol = [
    'b1' => 0.0,
    'b2' => -0.5,
    'b3' => -1.5,
    'b4' => -4.5,
];

$dieta = [
    'mala'  => -2.0,
    'mixta' => 0.0,
    'med'   => 2.5,
];

/** Tramos de IMC:*/
$tramosImc = [
    18.5 => -2.0,
    25.0 => 0.0,
    30.0 => -0.5,
    35.0 => -3.0,
    40.0 => -6.0,
    100  => -9.0,
];

// Función para escribir los años en español
function formatearAnios(float $anios): string
{
    $texto = number_format(abs($anios), 1, ',', '.');
    if ($anios > 0) return "+" . $texto;
    if ($anios < 0) return "−" . $texto;
    return $texto;
}

//1. Recoger los datos 
$sexo      = filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$tabaco    = filter_input(INPUT_POST, "tabaco", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$actividad = filter_input(INPUT_POST, "actividad", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$bebida    = filter_input(INPUT_POST, "alcohol", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
$comida    = filter_input(INPUT_POST, "dieta", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

// Altura y peso llegan como texto
$altura = filter_var(str_replace(",", ".", $_POST["altura"] ?? ""), FILTER_VALIDATE_FLOAT);
$peso   = filter_var(str_replace(",", ".", $_POST["peso"] ?? ""), FILTER_VALIDATE_FLOAT);


$errores = [];

// Sin sexo no hay punto de partida, así que este error sí impide calcular
if (!array_key_exists($sexo, ESPERANZA_BASE)) {
    $errores[] = "Elige un sexo de la lista.";
}

// Si la respuesta no existe en su array, ese factor se queda en 0 y se avisa
$ajusteTabaco = $fumador[$tabaco] ?? null;
$ajusteActividad = $ejercicio[$actividad] ?? null;
$ajusteAlcohol = $alcohol[$bebida] ?? null;
$ajusteDieta = $dieta[$comida] ?? null;

if ($ajusteTabaco === null)    $errores[] = "Tabaco: respuesta no válida. Este factor no se ha tenido en cuenta.";
if ($ajusteActividad === null) $errores[] = "Actividad física: respuesta no válida. Este factor no se ha tenido en cuenta.";
if ($ajusteAlcohol === null)   $errores[] = "Alcohol: respuesta no válida. Este factor no se ha tenido en cuenta.";
if ($ajusteDieta === null)     $errores[] = "Alimentación: respuesta no válida. Este factor no se ha tenido en cuenta.";

// IMC (código que daba el profe): solo se calcula si altura y peso están en rango
$imc = null;
$ajusteImc = null;
$datosValidos = $altura !== false && $peso !== false
    && $altura >= 120 && $altura <= 220 && $peso >= 30 && $peso <= 250;

if ($datosValidos) {
    $imc = $peso / (($altura / 100) ** 2);

    // Recorremos los tramos de menor a mayor y paramos en el primero que supere el IMC
    foreach ($tramosImc as $limite => $ajuste) {
        if ($imc < $limite) {
            $ajusteImc = $ajuste;
            break;
        }
    }
} else {
    $errores[] = 'Introduce una altura entre 120 y 220 cm y un peso entre 30 y 250 kg. Este factor no se ha tenido en cuenta.';
}


$hayResultado = array_key_exists($sexo, ESPERANZA_BASE);

if ($hayResultado) {
    [$etiquetaSexo, $base] = ESPERANZA_BASE[$sexo];

    // Lista de factores: [nombre, años]. Si un factor no es válido, cuenta 0
    $factores = [
        ['Tabaco', $ajusteTabaco ?? 0.0],
        ['Actividad física', $ajusteActividad ?? 0.0],
        ['Alcohol', $ajusteAlcohol ?? 0.0],
        ['Alimentación', $ajusteDieta ?? 0.0],
        ['Peso corporal', $ajusteImc ?? 0.0],
    ];

    // Sumamos todos los ajustes con un foreach
    $totalAjustes = 0.0;
    foreach ($factores as [$nombre, $anios]) {
        $totalAjustes += $anios;
    }
    $estimacion = $base + $totalAjustes;

    // Buscamos el factor que más resta 
    $peorNombre = "";
    $peorAnios = 0.0;
    foreach ($factores as [$nombre, $anios]) {
        if ($anios < $peorAnios) {
            $peorAnios = $anios;
            $peorNombre = $nombre;
        }
    }

    // Consejo según el factor que más resta
    $consejo = match ($peorNombre) {
        'Tabaco'           => "Dejar de fumar es el cambio con más efecto de todos los que te preguntamos.",
        'Actividad física' => "Llegar a los 150 minutos semanales que recomienda la OMS ya mejora tu cifra.",
        'Alcohol'          => "Reducir las bebidas a la semana es lo que más te acerca a tu punto de partida.",
        'Alimentación'     => "Cambiar carne procesada por legumbres y frutos secos es el cambio que más pesa en los modelos de Fadnes et al.",
        'Peso corporal'    => "Acercar tu IMC al tramo de 18,5 a 25 es lo que más te suma.",
        default            => "",
    };
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de longevidad</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <main class="container is-max-desktop section">
        <header class="block mb-6">
            <span class="tag is-primary is-light is-uppercase has-text-weight-semibold mb-2">
                <i class="fa fa-info-circle mr-1"></i>Estimación orientativa
            </span>
            <h1 class="title is-2">¿Cuántos años voy a vivir?</h1>
        </header>

        <!-- Avisos de validación (sintaxis alternativa con foreach / endforeach) -->
        <?php if (!empty($errores)): ?>
            <div class="notification is-danger is-light">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($hayResultado): ?>
            <section class="box mt-6" id="resultado">
                <div class="block">
                    <span class="tag is-primary is-medium mb-2">Tu estimación</span>
                    <div class="is-flex is-align-items-baseline">
                        <strong class="is-size-1 has-text-primary"><?= number_format($estimacion, 1, ',', '.') ?></strong>
                        <span class="is-size-4 has-text-grey ml-2">años</span>
                    </div>
                    <p class="has-text-grey is-size-7 mt-1">
                        Punto de partida (<?= strtolower($etiquetaSexo) ?>, España) <?= number_format($base, 1, ',', '.') ?>
                        <?= $totalAjustes < 0 ? "−" : "+" ?><?= number_format(abs($totalAjustes), 1, ',', '.') ?> por tus hábitos
                    </p>
                </div>

                <div class="block">
                    <h2 class="title is-4">Qué suma y qué resta cada hábito</h2>
                    <div class="content">
                        <?php foreach ($factores as [$nombre, $anios]): ?>
                            <?php

                            if ($anios > 0) {
                                $color = "is-success";
                                $icono = "fa-plus";
                            } elseif ($anios < 0) {
                                $color = "is-danger";
                                $icono = "fa-minus";
                            } else {
                                $color = "is-light";
                                $icono = "fa-circle-o";
                            }
                            // La barra se llena 10 puntos por cada año (máximo 100)
                            $barra = min(abs($anios) * 10, 100);
                            ?>
                            <div class="mb-3">
                                <div class="is-flex is-justify-content-space-between is-align-items-center mb-1">
                                    <span class="has-text-weight-semibold">
                                        <i class="fa <?= $icono ?> mr-2"></i><?= $nombre ?>
                                    </span>
                                    <span class="tag <?= $color ?>"><?= formatearAnios($anios) ?> años</span>
                                </div>
                                <progress class="progress <?= $color ?> is-small" value="<?= $barra ?>" max="100"><?= formatearAnios($anios) ?></progress>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if ($imc !== null): ?>
                    <p class="help mb-3">Tu IMC es <?= number_format($imc, 1, ',', '.') ?>.</p>
                <?php endif; ?>

                <div class="notification is-info is-light mt-4">
                    <?php if ($peorAnios < 0): ?>
                        <p>
                            <i class="fa fa-exclamation-triangle mr-2"></i>
                            <strong>Lo que más te resta es <?= strtolower($peorNombre) ?> (<?= formatearAnios($peorAnios) ?> años).</strong>
                            <?= $consejo ?>
                        </p>
                    <?php else: ?>
                        <p>
                            <i class="fa fa-check-circle mr-2"></i>
                            <strong>Ningún hábito te resta años.</strong> Sigue así.
                        </p>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <a class="button mt-4" href="ut03p02.html">Volver</a>
    </main>
</body>

</html>