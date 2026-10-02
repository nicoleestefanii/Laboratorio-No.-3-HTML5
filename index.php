<?php include 'includes/header.php'; ?>

<main class="container my-4 flex-grow-1">
    <section>
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Registro de Aspirantes</h1>

                <!-- enctype="multipart/form-data" es obligatorio para poder enviar la foto -->
                <form action="procesar.php" method="POST" enctype="multipart/form-data" novalidate>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   placeholder="Ej: Sofía" required>
                        </div>

                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                                   placeholder="Ej: Rodríguez" required>
                        </div>

                        <div class="col-md-6">
                            <label for="identificacion" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion"
                                   placeholder="Ej: 8-123-4567" required>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Sexo</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="Masculino" required>
                                <label class="form-check-label" for="sexoM">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="Femenino">
                                <label class="form-check-label" for="sexoF">Femenino</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="foto" class="form-label">Foto (jpg, jpeg, png, gif, webp)</label>
                            <input type="file" class="form-control" id="foto" name="foto"
                                   accept=".jpg,.jpeg,.png,.gif,.webp" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Registrar Aspirante</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
