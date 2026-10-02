# Laboratorio #3 - Registro de Aspirantes

Fecha: 02/10/2026

## Contenido del Repositorio

Este repositorio contiene el desarrollo del Laboratorio #3 de la asignatura de Desarrollo Web, correspondiente al Módulo II (Diseño Web con HTML5 y CSS3) y al Módulo III (Programación de Aplicaciones Web). Se implementó un formulario de **Registro de Aspirantes** que captura los datos básicos del usuario (nombre, apellido, identificación, fecha de nacimiento, sexo y foto), valida la información en el backend con PHP y almacena de forma segura la fotografía cargada, sin utilizar base de datos.

## Tecnologías Utilizadas

- Lenguaje / Framework: PHP, HTML5, CSS3
- Framework de estilos: Bootstrap v5.3.8
- Manejo de formularios: GET y POST
- Herramientas: Git, WampServer / XAMPP, Visual Studio Code


### Interfaz Principal

- **Formulario de Registro (index.php):** Formulario HTML con Bootstrap que solicita nombre, apellido, identificación, fecha de nacimiento, sexo y foto del aspirante. Utiliza el atributo `enctype="multipart/form-data"` para permitir el envío de archivos, y el atributo `placeholder` en cada campo para guiar al usuario sobre el formato esperado.
- **Procesamiento del Formulario (procesar.php):** Script backend encargado de validar que los campos no estén vacíos, estandarizar el texto de nombre y apellido a formato tipo título, calcular la edad a partir de la fecha de nacimiento (verificando el rango de 18 a 70 años), validar la extensión de la imagen (jpg, jpeg, png, gif, webp) y guardar la foto de forma segura en la carpeta `uploaded_files/`.

## Estructura de Carpetas o Directorios

```
TallerAspirantes/
├── uploaded_files/      # Fotos de los aspirantes guardadas por el backend
├── index.php            # Formulario de registro (HTML + Bootstrap)
├── procesar.php         # Backend: validación, saneamiento y guardado
└── README.md            # Documentación del proyecto
```

## Instrucciones de Ejecución / Uso

1. Clonar el repositorio dentro del directorio local del servidor (por ejemplo, `C:\wamp64\www\`).
2. Iniciar WampServer (o XAMPP) y verificar que los servicios de Apache estén activos.
3. Acceder al formulario desde el navegador, por ejemplo: `http://localhost/TallerAspirantes/index.php`.
4. Completar los campos del formulario y enviar la información.
5. Verificar que la foto se almacene correctamente en la carpeta `uploaded_files/` y que los datos se muestren saneados y validados.

## Autor y Contexto

- **Nombre:** Nicole Pinto, 8-1031-2426
- **Institución:** Universidad Tecnológica de Panamá (UTP)
- **Curso:** Desarrollo Web
- **Instructor:** Irina Fong
- **Fecha de Realización:** 02/10/2026

