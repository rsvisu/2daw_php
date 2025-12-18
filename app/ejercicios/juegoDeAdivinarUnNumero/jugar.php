<?php

// BOTONES DE SUBMIT ADICIONALES:

if (isset($_POST['submit'])) {
    $submit = htmlspecialchars(filter_input(INPUT_POST, "submit"));

    switch ($submit) {
        case "Volver":
            header("Location: index.php");
            exit;
            break;
        // En caso que se seleccione en el submit reinicar
        // todas las varibles del post se definiraran en null
        // para simular que es la primera vez que se juega al juego.
        case "Reiniciar":
            $_POST["min"] = null;
            $_POST["max"] = null;
            $_POST["jugada"] = null;
            $_POST["numActual"] = null;
            $_POST["operacion"] = null;
            break;
    }
}


// PROGRAMA PRINCIPAL:

// INTENTOS

// Recogemos el numero de intentos.
if (!isset($_POST['intentos'])) {
    $mensaje = "Tienes que seleccionar una opción a través de esta página para jugar!";
    header("Location: index.php?error=" . urlencode($mensaje));
    exit;
}
$intentos = (int) htmlspecialchars(filter_input(INPUT_POST, "intentos", FILTER_SANITIZE_NUMBER_INT));

// Comprobamos que el numero de intentos sea valido.
if (!($intentos == 10 || $intentos == 15 || $intentos == 20)) {
    $mensaje = "El número de intentos no es válido, seleccionalo a través de esta página para jugar!";
    header("Location: index.php?error=" . urlencode($mensaje));
    exit;
}

// MIN Y MAX

// Segun el numero de intentos sabemos el rango inicial donde adivinar.
$min = 0;
$max = match ($intentos) {
    10 => 1_023,
    15 => 65_535,
    20 => 1_048_575,
    default => 0        // Default obligatorio pero tecnicamente no necesario.
};

// En caso que ya se sea una partida empezada cogeremos el min y max de la ronda anterior.
if (isset($_POST['min']) && isset($_POST['max'])) {
    $min = (int) htmlspecialchars(filter_input(INPUT_POST, "min", FILTER_SANITIZE_NUMBER_INT));;
    $max = (int) htmlspecialchars(filter_input(INPUT_POST, "max", FILTER_SANITIZE_NUMBER_INT));;

    if ($min > $max) {
        $mensaje = "Ha ocurrido un problema, vuelve a empezar.";
        header("Location: index.php?error=" . urlencode($mensaje));
        exit;
    }
}

// JUGADA

// Obtenemos el numero de jugada. En caso de que no exista el campo jugada se dejara en 0.
$jugada = 1;
if (isset($_POST['jugada'])) {
    $jugada = (int) htmlspecialchars(filter_input(INPUT_POST, "jugada", FILTER_SANITIZE_NUMBER_INT));
}

// En caso de que la jugada supere el numero de intentos
// significando que 'no se ha adivinado el numero', se redirgira
// a la pagina de fin.
if ($jugada > $intentos) {
    header("Location: fin.php?exito=false&intentos=$intentos&jugada=$jugada");
    exit;
}

// NUMACTUAL

// Obtenemos el numero actual. En caso de que no exista el campo num se dejara en 0 por tener que inicializarlo.
$numActual = 0;
if (isset($_POST['numActual'])) {
    $numActual = (int) htmlspecialchars(filter_input(INPUT_POST, "numActual"));
}

// OPERACION

// Obtenemos la operacion de la jugada. En caso de que no exista el campo operacion se dejara en null para
// posteriormente calcular el numero incial del juego.
$operacion = null;
if (isset($_POST['operacion'])) {
    $operacion = htmlspecialchars(filter_input(INPUT_POST, "operacion"));
}

// Hacemos las operaciones neccesarias para la ronda.
switch ($operacion) {
    case "mayor":
        $min = $numActual;
        $numActual = round(($min + $max) / 2);
        $jugada++;
        break;
    case "menor":
        $max = $numActual;
        $numActual = round(($min + $max) / 2);
        $jugada++;
        break;
    case "igual":
        header("Location: fin.php?exito=true&intentos=$intentos&jugada=$jugada");
        exit;
        break;
    case null:
        $numActual = round(($min + $max) / 2);
        break;
}

?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Práctica 3 - Juego de Adivinar un Número</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="hero min-h-screen bg-base-200 flex items-center justify-center">
    <div class="max-w-lg bg-white shadow-lg rounded-lg p-8 text-gray-800">
        <h1 class="text-5xl font-bold text-gray-800 mb-4">Empieza el Juego</h1>
        <p class="text-lg text-gray-600 mb-6">Información y opciones del juego</p>

        <form action="jugar.php" method="POST">
            <div class="bg-slate-300 p-5 rounded-lg mb-4">
                <h4 class="text-2xl font-semibold mb-2">Jugada nº <?="$jugada"?></h4>
                <h2 class="text-xl">¿El número es <span class="font-bold"><?="$numActual"?></span>?</h2>
            </div>

            <input type="hidden" value="<?=$intentos?>" name="intentos">
            <input type="hidden" value="<?=$numActual?>" name="numActual">
            <input type="hidden" value="<?=$jugada?>" name="jugada">
            <input type="hidden" value="<?=$min?>" name="min">
            <input type="hidden" value="<?=$max?>" name="max">

            <fieldset id="adivina" class="bg-gray-100 p-4 rounded-lg mb-4">
                <legend class="text-lg font-semibold mb-2">El número a adivinar es</legend>
                <label class="flex items-center mb-2">
                    <input type="radio" checked class="radio radio-primary mr-2" name="operacion"
                           value="mayor">
                    <span>Mayor</span>
                </label>
                <label class="flex items-center mb-2">
                    <input type="radio"  class="radio radio-primary mr-2" name="operacion"
                           value="menor">
                    <span>Menor</span>
                </label>
                <label class="flex items-center mb-2">
                    <input type="radio" class="radio radio-primary mr-2" name="operacion" value="igual">
                    <span>Igual</span>
                </label>
            </fieldset>

            <div class="flex space-x-4 mt-6">
                <input type="submit" value="Jugar" name="submit" class="btn btn-primary flex-1">
                <input type="submit" value="Reiniciar" name="submit" class="btn btn-secondary flex-1">
                <input type="submit" value="Volver" name="submit" class="btn btn-accent flex-1">
            </div>
        </form>
    </div>
</div>
</body>
</html>
