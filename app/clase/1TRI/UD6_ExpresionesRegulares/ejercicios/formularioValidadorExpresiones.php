<?php

require_once "ExpresionRegular.php";

$inputsPresentes = isset($_POST["patron"]) && isset($_POST["cadena"]);
if ($inputsPresentes) {
    // Recogemos las variables.
    $patron = filter_input(INPUT_POST, "patron");
    $cadena = filter_input(INPUT_POST, "cadena");

    // Comprobamos la validez de la expresión.
    $patronCumplido = ExpresionRegular::validar("#$patron#", $cadena);
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
    <legend>Validador expresiones regulares:</legend>
    <form action="#" method="POST">
        <label for="patron">Expresion regular:</label><br>
        <input type="text" name="patron" id="patron" value="<?=$patron ?? '' ?>"><br>

        <label for="cadena">Cadena a validar:</label><br>
        <input type="text" name="cadena" id="cadena" value="<?=$cadena ?? '' ?>"><br>

        <input type="submit" value="Enviar">
    </form>
</fieldset>
<?php if ($inputsPresentes): ?>
    <div>
        <?php if ($patronCumplido): ?>
            <p style="color: green">La expresión "<?=$patron?>" si que se cumple en la cadena "<?=$cadena?>".</p>
        <?php else: ?>
            <p style="color: red">La expresión "<?=$patron?>" no se cumple en la cadena "<?=$cadena?>".</p>
        <?php endif; ?>
    </div>
<?php endif; ?>
</body>
</html>
