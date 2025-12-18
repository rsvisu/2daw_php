<?php

$vecesTiradas = 6000;
$i = 0;
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
$num5 = 0;
$num6 = 0;
while ($i < $vecesTiradas) {
    $dado = rand(1,6);
    switch ($dado) {
        case 1:
            $num1++;
            break;
        case 2:
            $num2++;
            break;
        case 3:
            $num3++;
            break;
        case 4:
            $num4++;
            break;
        case 5:
            $num5++;
            break;
        case 6:
            $num6++;
            break;
    }
    $i++;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de PHP en HTML</title>
    <style>
        .box{
            border: 2px solid #007BFF;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #ffffff;
        }
        .resultado{
            border: 2px solid #007BFF;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #ffffff;
        }
        .box h2{
            margin-top: 0;
            color: #007BFF;
        }

        body{
            font-family: Arial, sans-serif;
            height: 100vh;
            background-color: #f5f5f5;
            width: 80%;
            max-width: 90%;
            margin: auto;
        }
        hr{
            height: 5px;
            background:green
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <h2>Texto enunciado breve</h2>
        <ul>
            <li>Guardar frecuencia de lanzar un dado de 6 numeros 6000 veces.</li>
        </ul>
    </div>

    <!-- Sección para el resultado de PHP -->
    <div class="box">
        <h2>Resultado</h2>
        <hr>
        <h3>Numero 1:</h3>
        <?="$num1"?>
        <h3>Numero 2:</h3>
        <?="$num2"?>
        <h3>Numero 3:</h3>
        <?="$num3"?>
        <h3>Numero 4:</h3>
        <?="$num4"?>
        <h3>Numero 5:</h3>
        <?="$num5"?>
        <h3>Numero 6:</h3>
        <?="$num6"?>
    </div>

</div>
</body>
</html>