<?php

require "../../vendor/autoload.php";

use Class\DataBase\BaseDatos;
use Class\View\Plantilla;

$con = BaseDatos::getInstance();

$tablas = $con->getAllTables();

$verTabla = false;
if (isset($_POST["tabla"])) {
    $tabla = filter_input(INPUT_POST, "tabla");
    $verTabla = true;
    $htmlTabla = Plantilla::getHtmlTableOfContentTable($tabla, $con);
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
            min-height: 100vh;
            font-family: sans-serif;
        }

        fieldset, div {
            background: antiquewhite;
            width: fit-content;
            margin: 10px;
            border: solid 1px grey;
        }

        div {
            padding: 10px;
        }
    </style>
</head>
<body>
<fieldset style="background: antiquewhite;">
    <legend>Ver tablas:</legend>
    <form action="#" method="POST">
        <?php if (!$verTabla): ?>
            <?php
            foreach ($tablas as $tabla) {
                echo "<input type='submit' name='tabla' value='$tabla'>\n";
            }
            ?>
        <?php else: ?>
            <?= $htmlTabla ?>
            <a href="">
                <div style="background-color: whitesmoke">Volver</div>
            </a>
        <?php endif; ?>
    </form>
</fieldset>
</body>
</html>
