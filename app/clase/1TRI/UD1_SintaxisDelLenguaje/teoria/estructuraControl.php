<?php

// Switch en la parte de controlador y luego se imprime en el HTML.
$edad = rand(1, 150);
$mensaje = "";
switch (true) {
    case ($edad >= 0 and $edad <= 3):
        $mensaje = "Eres un bebe";
        break;
    case ($edad <= 11):
        $mensaje = "Eres un niño";
        break;
    case ($edad <= 17):
        $mensaje = "Eres un adolescente";
        break;
    case ($edad <= 30):
        $mensaje = "Eres un joven";
        break;
    case ($edad <= 60):
        $mensaje = "Eres un adulto";
        break;
    case ($edad <= 90):
        $mensaje = "Eres un experimentado";
        break;
    case ($edad <= 120):
        $mensaje = "Eres un anciano";
        break;
    default:
        $mensaje = "Eres un alien";
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>If Else con HTML:</h1>
    <?php if (true): ?>
        <p>Este contenido se mostrará</p>
    <?php else: ?>
        <p>Este contenido no se mostrará</p>
    <?php endif; ?>

    <h1>Switch en parte de controlador:</h1>
    <?="Edad: $edad"?>
    <br>
    <?="$mensaje"?>
</body>
</html>
