<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        main {
            width: fit-content;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <main>
    <?php

        $numEncabezado = rand(1,6);
        $numAleatorio = rand(0,0xFFFFFF);

        // Formateamos los numeros de los encabezados y el numero decimal del color en hexadecimal.
        printf("<h%d style='color:#%06x'>Color Aleatorio</h%d>",
            $numEncabezado,
            $numAleatorio,
            $numEncabezado);

    ?>
    </main>
</body>
</html>