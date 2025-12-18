<?php
$submit = $_POST["submit"] ?? null;

// En vez de poner el ?? tambien se puede hacer asi:
/*
if (isset($_POST["submit"])) {
    $submit = $_POST["submit"];
} else {
    $submit = null;
}
*/

if (isset($_GET["mensaje"])) {
    $mensaje = htmlspecialchars(filter_input(INPUT_GET, "mensaje"));;
}

if (!is_null($submit)) {
    // El filter_input en este caso no hace nada porque no se esta poniendo el tercer parametro
    // para que filtre algo realmente, pero lo estamos poniendo para acostumbranos.
    $nombre = htmlspecialchars(filter_input(INPUT_POST, "nombre"));
    $contrasena = htmlspecialchars(filter_input(INPUT_POST, "contrasena"));

    if (($nombre == $contrasena) && ($nombre != "")) {
        header("Location: acceso.php?nombre=$nombre");
        exit();
    } else {
        $mensaje = "Credenciales no validas";
    }
}

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
    <legend>Formulario: </legend>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena">

        <input type="submit" name="submit" value="Enviar">
    </form>
</fieldset>
<?php
if (isset($mensaje)) {
    echo "<fieldset><h4>$mensaje.</h4></fieldset>";
}
?>
</body>
</html>