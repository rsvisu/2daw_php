<?php

$numParesASumar = 100;

// Solucion personal:
$total1 = 0;
$cont1 = 0;
while($cont1 < $numParesASumar){
    $total1 += $cont1 * 2;
    $cont1++;
}

// Solucion profesor:
$numerosSumados = 0;
$total2 = 0;
$cont2 = 0;
while($numerosSumados < $numParesASumar){
    if ($cont2%2 == 0){
        $total2 += $cont2;
        $numerosSumados++;
    }
    $cont2++;
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
            <li>Sumar los 100 primeros numeros pares usando while.</li>
        </ul>
    </div>

    <!-- Sección para el resultado de PHP -->
    <div class="box">
        <h2>Resultado</h2>
        <hr>

        <h1>Total 1:</h1>
        <?="$total1"?>
        <h1>Total 2:</h1>
        <?="$total2"?>
    </div>

</div>
</body>
</html>