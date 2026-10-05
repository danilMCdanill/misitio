<?php
// Cabecera común: <head> con librerías + barra de navegación
// Uso: definir $tituloPagina antes de hacer el include
$tituloPagina = $tituloPagina ?? "Mi Sitio";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($tituloPagina) ?></title>

    <!-- Estilos: Bulma + Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts: Alpine JS + Axios -->
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <nav class="navbar is-dark" role="navigation" aria-label="navegación principal">
        <div class="navbar-brand">
            <a class="navbar-item has-text-weight-bold" href="index.php">
                <i class="fa fa-code mr-2"></i> Mi Sitio
            </a>
        </div>
        <div class="navbar-menu is-active">
            <div class="navbar-start">
                <a class="navbar-item" href="index.php">Inicio</a>
                <a class="navbar-item" href="practica01.php">Práctica 01 (API)</a>
            </div>
        </div>
    </nav>

    <main class="section">
        <div class="container">
