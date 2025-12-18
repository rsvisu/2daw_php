<?php

// Match es un operador no una estructura de control por lo tanto devuelve un valor y se puede asignar a una variable.
$mes = rand(1, 12);
$mensaje = match ($mes){
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre",
    default => "Error"
};

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>Match:</h1>
    <?="Mes: $mes"?>
    <br>
    <?="$mensaje"?>
</body>
</html>
