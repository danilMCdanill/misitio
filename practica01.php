<?php
/**
 * Práctica 01 - Mini API REST en PHP
 *  GET  -> consulta con filtro opcional ?categoria=...
 *  POST -> alta de usuario (JSON con "usuario" y "email")
 *  Otro -> 405 Método no permitido
 */

// Todas las respuestas se devuelven en JSON
header("Content-Type: application/json; charset=UTF-8");

/**
 * Envía la respuesta con su código HTTP y termina la ejecución
 */
function responder(int $codigo, array $datos): void
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

$metodoHttp = $_SERVER["REQUEST_METHOD"];

switch ($metodoHttp) {
    case "GET":
        // Parámetro opcional recibido por la URL
        $filtro = $_GET["categoria"] ?? "todas";

        responder(200, [
            "estado"    => "ok",
            "metodo"    => $metodoHttp,
            "mensaje"   => "Consulta procesada correctamente",
            "categoria" => $filtro,
        ]);
        break;

    case "POST":
        // El cuerpo de la petición llega en formato JSON
        $cuerpo = json_decode(file_get_contents("php://input"), true) ?? [];

        // Comprobamos que vengan los campos obligatorios
        $faltan = array_diff(["usuario", "email"], array_keys($cuerpo));

        if (!empty($faltan)) {
            responder(400, [
                "estado"  => "error",
                "mensaje" => "Campos obligatorios sin enviar: " . implode(", ", $faltan),
            ]);
        }

        responder(201, [
            "estado"   => "ok",
            "metodo"   => $metodoHttp,
            "mensaje"  => "Usuario dado de alta correctamente",
            "recibido" => $cuerpo,
        ]);
        break;

    default:
        responder(405, [
            "estado"  => "error",
            "mensaje" => "Método $metodoHttp no permitido",
        ]);
}
