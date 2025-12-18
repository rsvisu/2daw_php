<?php

if (!isset($_GET["nombre"])) {
    header("Location: index.php?mensaje=Debes indentificarte");
    exit();
}

$nombre = htmlspecialchars(filter_input(INPUT_GET, "nombre"));

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        fieldset {
            background: antiquewhite;
            width: fit-content;
            margin: 10px;
            min-width: 200px;
        }
        fieldset input {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<fieldset>
    <h3><?="Tu nombre es: $nombre."?></h3>
</fieldset>
</body>
</html>
