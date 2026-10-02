<?php
// includes/header.php
// Se incluye en todas las páginas para modularizar el <head>, el menú y las migas de pan.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Viewport: asegura que el diseño responsivo de Bootstrap se adapte a móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Facultad de Ingeniería de Sistemas Computacionales - UTP">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#212529">
    <title>Registro de Aspirantes - UTP</title>

    <!-- Bootstrap v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=4">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pink">
        <div class="container">
            <a class="navbar-brand fs-3 fw-bold" href="index.php">Desarrollo Web</a>
        </div>
    </nav>

    <!-- Migas de pan -->
    <nav aria-label="breadcrumb" class="container mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de Aspirantes</li>
        </ol>
    </nav>
</header>
