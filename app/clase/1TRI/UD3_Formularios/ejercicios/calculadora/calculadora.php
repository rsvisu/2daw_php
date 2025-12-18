<?php
// IPO

// Leo los datos de entrada:
$op1 = $_POST['op1'];
$op2 = $_POST['op2'];
$operador = $_POST['operador'];

// Inicializo variables:
$mensaje = "";
$resultado = 0;

// Valido los datos:
if (!(is_numeric($op1) && is_numeric($op2))) {
    $mensaje = "Los operadores no son numeros.";
} else if ($operador === "/" && $op2 === "0") {
    $mensaje = "No se puede dividr entre 0.";
}

// En funcion del operador realizo los calculos:
if ($mensaje === "") {
    $resultado = match ($operador) {
        "+" => $op1 + $op2,
        "-" => $op1 - $op2,
        "*" => $op1 * $op2,
        "/" => $op1 / $op2
    };
    $mensaje = "$op1 $operador $op2 = $resultado";
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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #resultado {
            text-align: center;
            border-radius: 10px;
            box-shadow: black 5px 5px 7px;
            padding: 40px 80px;
            background-color: antiquewhite;
        }
    </style>
</head>
<body>
    <main>
        <div id="resultado">
            <h1>Resultado:</h1>
            <h2><?="$mensaje"?></h2>
            <a href="calculadora.html">Volver</a>
        </div>
    </main>
</body>
</html>
