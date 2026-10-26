<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Productos</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css";
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <section class="section">
        <div class="container" style="max-width: 900px;">
            <div class="level">
                <div class="level-left">
                    <h1 class="title">
                        <i class="fa fa-boxes"></i> Resultados de Productos
                    </h1>
                </div>
                <div class="level-right">
                    <a href="https://misitio.test/formulario.php" class="button is-light">
                        <i class="fa fa-arrow-left mr-2"></i> Nueva Búsqueda
                    </a>
                </div>
            </div>

            <!-- Resumen de Filtros Aplicados -->
            <div class="notification is-info is-light">
                <p><strong>Filtros aplicados:</strong></p>
                <ul>
                    <li>Categoría: <strong>Electrónica</strong></li>
                    <li>Rango de precio: 
                        <strong>
                            Mínimo                            -
                            111,00 €                        </strong>
                    </li>
                    <li>Disponibilidad: <strong>Todos</strong></li>
                </ul>
            </div>

            <!-- Tabla de Resultados -->
                            <div class="notification is-warning">
                    <i class="fa fa-exclamation-triangle"></i> No se encontraron productos que cumplan con los criterios seleccionados.
                </div>
            
        </div>
    </section>


<protonpass-root-db30 data-protonpass-role="root" data-protonpass-theme="os"><template shadowrootmode="closed"></template></protonpass-root-db30></body></html>