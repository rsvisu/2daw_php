<?php
// Recuperamos el array de nombres o si no hay inicilizamos uno nuevo.
$nombres = $_POST["nombres"] ?? [];

if (!empty($_POST["nombre"])) {
    // Recogemos el nombre y la capitalizamos.
    $nombre = filter_input(INPUT_POST,"nombre");
    $nombre = ucfirst(strtolower($nombre));

    // Si existe una clave en nombres para el nombre enviado le sumamos uno.
    if (isset($nombres[$nombre])) {
        $nombres[$nombre]++;
    }
    // Si no creamos la clave y la establecemos a 1.
    else {
        $nombres[$nombre] = 1;
    }
}

// Finalmente creamos el mensaje.
$mensaje = "";
foreach ($nombres as $nombre => $cantidad) {
    $mensaje .= "<p>$nombre: $cantidad</p>\n";
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
        }
        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <main>
        <fieldset style="background: antiquewhite">
            <legend>Recuentos nombre:</legend>
            <form action="#" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre">
                <?php
                foreach ($nombres as $nombre => $cantidad) {
                    echo "<input type='hidden' name='nombres[$nombre]' value='$cantidad'>";
                }
                ?>
                <input type="submit" value="Click">
            </form>
            <?php
            if (!empty($mensaje)) {
                echo "<h3>Recuento:</h3>";
                echo $mensaje;
            }
            ?>
        </fieldset>
    </main>
</body>
</html>
