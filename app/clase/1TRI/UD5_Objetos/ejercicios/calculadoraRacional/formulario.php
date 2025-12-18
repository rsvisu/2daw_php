<?php
// Importamos la clase.
use UD5_Objetos\ejercicios\calculadoraRacional\Racional;

require_once("Racional.php");

// Si están establecidos los parámetros operamos.
if (isset($_POST["num"]) && isset($_POST["den"])) {
    // Recogemos los valores.
    $num = filter_input(INPUT_POST, "num");
    $den = filter_input(INPUT_POST, "den");

    if (is_numeric($num) || empty($num)) {
        $racional = new Racional(intval($num), intval($den));
    } else {
        $racional = new Racional($num);
    }

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
            height: 100vh;
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
        <legend>Numero racional:</legend>
        <form action="#" method="POST">
            <label for="num">Numerador (o racional completo):</label><br>
            <input type="text" name="num" id="num"><br>

            <label for="den">Denominador: </label><br>
            <input type="text" name="den" id="den"><br><br>

            <input type="submit" value="Enviar">
        </form>
    </fieldset>
    <?php if (isset($racional)): ?>
    <div>
        <h3>Tu numero racional es:</h3>
        <p style="text-align: center"><?=$racional?></p>
    </div>
    <?php endif; ?>
</body>
</html>
