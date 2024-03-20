<?php
// Permitir cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");

// Verificar si se proporciona una URL válida en los parámetros GET
if (!isset($_GET['url']) || empty($_GET['url'])) {
    http_response_code(400);
    echo "Error: URL no especificada";
    exit();
}

// Obtener la URL de destino de los parámetros GET
$targetUrl = $_GET['url'];

// Crear una solicitud cURL para reenviar la solicitud al servidor de destino
$ch = curl_init($targetUrl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Ejecutar la solicitud cURL y obtener la respuesta
$response = curl_exec($ch);

// Verificar si hubo errores durante la ejecución de la solicitud cURL
if(curl_errno($ch)) {
    http_response_code(500);
    echo "Error en la solicitud: " . curl_error($ch);
    exit();
}

// Cerrar la sesión cURL
curl_close($ch);

// Devolver la respuesta al cliente
echo $response;
?>
