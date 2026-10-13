<?php
// Cabecera común: <head> con librerías + barra de navegación
// Uso: definir $tituloPagina antes de hacer el include
$tituloPagina = $tituloPagina ?? "Mi Sitio";
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
