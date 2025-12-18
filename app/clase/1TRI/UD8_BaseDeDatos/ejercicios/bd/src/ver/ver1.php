<?php

require  "../../vendor/autoload.php";
use Class\DataBase\BaseDatos;
use Class\View\Plantilla;

$con = BaseDatos::getInstance();

$tablas = $con->getAllTables();

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border-collapse: collapse;
        }
        td, th{
            border: black solid 1px;
            white-space: pre-line;
        }
        th {
            color: white;
            background-color: grey;
        }
        tr:nth-child(even) {
            background-color: whitesmoke;
        }

        #tablas div {
            margin: 5px;
            margin-left: 0;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Tablas</h1>
    <hr>
    <h2>Tablas en la base de datos:</h2>
    <?php
    foreach ($tablas as $tabla) {
        echo "<span>$tabla</span>\n";
    }
    ?>

    <h2>Contenido de la tabla 'familia':</h2>
    <?=Plantilla::getHtmlTableOfContentTable("familia", $con)?>

    <h2>Contenido de todas las tablas:</h2>
    <div id="tablas">
        <?php foreach ($tablas as $tabla): ?>
        <div>
            <h3><?="$tabla:"?></h3>
            <?=Plantilla::getHtmlTableOfContentTable($tabla, $con)?>
        </div>
        <?php endforeach; ?>
    </div>


</body>
</html>
