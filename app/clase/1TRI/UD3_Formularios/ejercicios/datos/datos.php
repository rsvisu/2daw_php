<?php
$nombre = htmlspecialchars($_POST['nombre']);
$contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
$edad = filter_input(INPUT_POST, 'edad', FILTER_SANITIZE_NUMBER_INT);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <main>
        <fieldset style="background: antiquewhite;width:70%;margin:20%">
            <legend>Ficha de datos:</legend>
            <h3>Nombre: <?="$nombre"?></h3>
            <h3>Contraseña: <?="$contrasena"?></h3>
            <h3>Edad: <?="$edad"?></h3>
            <a href="datos.html">Volver</a>
        </fieldset>
    </main>
</body>
</html>