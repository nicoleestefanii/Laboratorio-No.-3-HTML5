<?php
/**
 * procesar.php
 * Backend del Registro de Aspirantes.
 * - Valida que los campos no estén vacíos.
 * - Sanea la entrada (htmlspecialchars, strip_tags, trim).
 * - Estandariza nombre/apellido a formato tipo título e identificación a mayúsculas.
 * - Calcula la edad y valida el rango 18-70 años.
 * - Valida la extensión de la foto y la guarda de forma segura en uploaded_files/.
 */

$errores = [];
$datos = [];

/**
 * Sanea un campo de texto: quita etiquetas, convierte caracteres especiales
 * a entidades HTML seguras y elimina espacios sobrantes.
 */
function sanear_texto(string $valor): string
{
    $valor = trim($valor);
    $valor = strip_tags($valor);
    $valor = htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
    return $valor;
}

/** Convierte a formato tipo título: "sofia rodriguez" -> "Sofia Rodriguez" */
function formato_titulo(string $valor): string
{
    return ucwords(strtolower($valor));
}

/** Calcula la edad exacta a partir de una fecha de nacimiento (Y-m-d). */
function calcular_edad(string $fechaNacimiento): ?int
{
    $hoy = new DateTime();
    $nacimiento = DateTime::createFromFormat('Y-m-d', $fechaNacimiento);
    if (!$nacimiento) {
        return null;
    }
    return $hoy->diff($nacimiento)->y;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- 1. Validar y sanear campos de texto ---
    $camposRequeridos = ['nombre', 'apellido', 'identificacion', 'fecha_nacimiento', 'sexo'];
    foreach ($camposRequeridos as $campo) {
        if (empty(trim($_POST[$campo] ?? ''))) {
            $errores[] = "El campo '$campo' es obligatorio.";
        }
    }

    if (empty($errores)) {
        $nombre         = formato_titulo(sanear_texto($_POST['nombre']));
        $apellido       = formato_titulo(sanear_texto($_POST['apellido']));
        $identificacion = strtoupper(sanear_texto($_POST['identificacion']));
        $sexo           = sanear_texto($_POST['sexo']);
        $fechaNacimiento = sanear_texto($_POST['fecha_nacimiento']);

        // --- 2. Validar edad (18 a 70 años) ---
        $edad = calcular_edad($fechaNacimiento);
        if ($edad === null) {
            $errores[] = "La fecha de nacimiento no es válida.";
        } elseif ($edad < 18 || $edad > 70) {
            $errores[] = "La edad calculada ($edad años) debe estar entre 18 y 70 años.";
        }

        $datos = compact('nombre', 'apellido', 'identificacion', 'sexo', 'fechaNacimiento', 'edad');
    }

    // --- 3. Validar y guardar la foto ---
    $rutaRelativaFoto = null;

    if (empty($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        $errores[] = "Debe adjuntar una foto válida.";
    } else {
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $nombreOriginal = basename($_FILES['foto']['name']);
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesPermitidas, true)) {
            $errores[] = "Formato de imagen no permitido. Use: " . implode(', ', $extensionesPermitidas) . ".";
        } else {
            $carpetaDestino = __DIR__ . '/uploaded_files/';
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0755, true);
            }

            // Nombre único para evitar sobrescribir archivos existentes
            $nombreArchivo = uniqid('aspirante_', true) . '.' . $extension;
            $rutaDestino = $carpetaDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                $rutaRelativaFoto = 'uploaded_files/' . $nombreArchivo;
            } else {
                $errores[] = "Ocurrió un error al guardar la foto.";
            }
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<main class="container my-4 flex-grow-1">
    <section>
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Resultado del Registro</h1>

                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <strong>Se encontraron los siguientes errores:</strong>
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="index.php" class="btn btn-secondary">Volver al formulario</a>

                <?php else: ?>
                    <div class="alert alert-success">Aspirante registrado correctamente.</div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Nombre:</strong> <?php echo $datos['nombre']; ?></li>
                        <li class="list-group-item"><strong>Apellido:</strong> <?php echo $datos['apellido']; ?></li>
                        <li class="list-group-item"><strong>Identificación:</strong> <?php echo $datos['identificacion']; ?></li>
                        <li class="list-group-item"><strong>Sexo:</strong> <?php echo $datos['sexo']; ?></li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> <?php echo $datos['fechaNacimiento']; ?></li>
                        <li class="list-group-item"><strong>Edad:</strong> <?php echo $datos['edad']; ?> años</li>
                    </ul>
                    <a href="index.php" class="btn btn-primary">Registrar otro aspirante</a>
                <?php endif; ?>

            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
