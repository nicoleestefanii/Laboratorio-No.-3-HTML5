<?php
/**
 * foto.php
 * Entrega al navegador una foto guardada en uploaded_files/.
 * La carpeta uploaded_files/ está bloqueada con .htaccess (no se puede abrir
 * directamente desde el navegador), así que PHP lee el archivo desde el
 * servidor y lo muestra. Uso: foto.php?f=nombre_del_archivo.jpg
 */

// basename() elimina cualquier ruta (../) que intenten colar en el parámetro
$nombre = basename($_GET['f'] ?? '');

// Solo se aceptan nombres con el formato que genera procesar.php
if (!preg_match('/^aspirante_[a-z0-9.]+\.(jpg|jpeg|png|gif|webp)$/i', $nombre)) {
    http_response_code(404);
    exit('Archivo no encontrado.');
}

$ruta = __DIR__ . '/uploaded_files/' . $nombre;

if (!is_file($ruta)) {
    http_response_code(404);
    exit('Archivo no encontrado.');
}

$tiposMime = [
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'webp' => 'image/webp',
];
$extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

header('Content-Type: ' . $tiposMime[$extension]);
header('Content-Length: ' . filesize($ruta));
header('X-Content-Type-Options: nosniff');
readfile($ruta);
