<?php
// Codigo correspondiente al controlador.
// Logica que genre valores pero nunca se imprimira el texto.

$numRand = rand(1,10);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<!-- Forma uno de hacer solo un echo: -->
<?php echo "$numRand" ?>

<!-- Forma dos de hacer solo un echo: -->
<?="$numRand"?>

</body>
</html>
