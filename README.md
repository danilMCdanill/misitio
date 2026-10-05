# Mi Sitio

Proyecto web desarrollado con PHP y MySQL como práctica de la asignatura, siguiendo una estructura modular con separación de includes (cabecera, pie y conexión a base de datos), assets estáticos (CSS, JS, imágenes) y carpeta de subidas de archivos.

**NRE:** 2903602

## Diario de modificaciones

- **21/09/2026** — Creación de la estructura inicial del proyecto (carpetas `assets/`, `includes/`, `uploads/`, `index.php`).
- **29/09/2026** - He implementado las siguientes librerias css Herramientas: Bulma css / Font awesome, tambien añadi las siguientes librerias : Alpine JS / Axios JS

- **05/10/2026** — Cabecera y pie reutilizables en `includes/` (navbar con enlaces a las páginas). `index.php` reorganizado: botones de color generados con un array y bucle, nuevo color naranja, formulario con icono. `practica01.php` (API REST GET/POST) refactorizada con `switch` y función `responder()`. Añadido `.gitignore`.

## Estructura

```
misitio/
├── includes/
│   ├── header-navigation.php   # <head>, librerías y navbar
│   ├── footer-info.php         # pie de página
│   └── db-connection.php       # conexión a BD (pendiente)
├── index.php                   # saludo dinámico por GET
└── practica01.php              # mini API REST (JSON)
```

## Prueba rápida de la API

- `GET  http://misitio.test/practica01.php?categoria=libros`
- `POST http://misitio.test/practica01.php` con body JSON `{"usuario":"ana","email":"ana@mail.com"}`
