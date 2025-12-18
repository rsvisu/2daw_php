<?php
    // Importamos Racional.
use UD5_Objetos\ejercicios\calculadoraRacional\Racional;

require_once "Racional.php";

    // Si estan definidos los racionales operamos.
    if (isset($_POST["r1"]) && isset($_POST["r2"])) {
        $r1 = htmlspecialchars(filter_input(INPUT_POST, "r1"));
        $r2 = htmlspecialchars(filter_input(INPUT_POST, "r2"));
        $op = htmlspecialchars(filter_input(INPUT_POST, "op"));

        if (empty($r1) || empty($r2)) {
            $error = "Debes proporcionar los dos números.";
        } else {
            $r1 = new Racional($r1);
            $r2 = new Racional($r2);

            // Operamos segun el operador y guardamos el resultado.
            $resultado = match ($op) {
                "+" => $r1->suma($r2),
                "-" => $r1->resta($r2),
                "*" => $r1->multiplicacion($r2),
                "/" => $r1->division($r2),
            };
        }
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora racionales</title>
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
        <legend>Calculadora racionales:</legend>
        <form action="#" method="POST">
            <input type="text" name="r1" id="r1" placeholder="7/8">
            <select name="op" id="op">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="text" name="r2" id="r2" placeholder="2/5">
            <input type="submit" value="Enviar">
        </form>
        <?php
        if (!empty($resultado)) {
            echo "<h3>Resultado:</h3>\n";
            echo "<p>$resultado</p>\n";

            $simplificado = $resultado->simplificar();
            if ($resultado != $simplificado) {
                echo "<h4>Resultado simplificado:</h4>\n";
                echo "<p>$simplificado</p>\n";
            }
        }
        ?>
        <?php
        if (!empty($error)) {
            echo "<p style='color: red'>$error</p>";
        }
        ?>
    </fieldset>
</body>
</html>
