<?php
// Descargamos el json.
$url = "https://raw.githubusercontent.com/MAlejandroR/json_tv/main/tv.json";
$contenido = file_get_contents($url);
// Lo parseamos en un array asociativo.
$contenido = json_decode($contenido, true);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        section {
            background: aliceblue;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        section a{
            width: 200px;
            display: inline-block;
            text-align: center;
            margin: 5px;
        }
        section img {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            box-shadow: 3px 3px 5px black;
        }
    </style>
</head>
<body>
<main>
    <?php
    foreach ($contenido as $seccion) {
        // Nombre de la seccion.
        $nombre = trim($seccion["name"]);
        $id = strtolower($nombre);

        // Encabezado y div de la seccion.
        echo "<section id=$id>\n";
        echo "<h1>$nombre</h1>\n";

        // Canales de la seccion.
        foreach ($seccion["channels"] as $canal) {
            echo "<a href='{$canal["web"]}'><img src='{$canal["logo"]}' alt='{$canal["name"]}'></a>\n";
        }
        echo "</section>\n";
    }
    ?>
</main>
</body>
</html>
