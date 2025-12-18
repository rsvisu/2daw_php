<?php
$submit = $_POST["submit"] ?? "GET";
$mensaje = match ($submit) {
    "Acceder" => "Has seleccionado 'Acceder'",
    "Borrar" => "Has seleccionado 'Borrar'",
    "Cancelar" => "Has seleccionado 'Cancelar'",
    "Listar" => "Has seleccionado 'Listar'",
    "GET" => "Has accedido sin enviar el formulario a traves de 'GET'",
    default => "Opcion no valida"
};
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
        }
    </style>
</head>
<body>
    <fieldset>
        <legend>Opciones</legend>
        <form action="submit.php" method="POST">
            <input type="submit" name="submit" value="Acceder">
            <input type="submit" name="submit" value="Borrar">
            <input type="submit" name="submit" value="Cancelar">
            <input type="submit" name="submit" value="Listar">
        </form>
    </fieldset>
    <fieldset>
        <?="<h4>$mensaje.</h4>"?>
    </fieldset>


</body>
</html>
