<?php
require 'vendor/autoload.php';

use Clases\Juego\Clave;
use Clases\Juego\Jugada;
use Clases\Juego\Plantilla;
use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    die("ERROR: No se pudo cargar el archivo .env.");
}

session_start();

$jugadas = $_SESSION['jugadas'] ?? [];
$win = $_GET['win'] ?? "";
$intento = sizeof($jugadas);
$clave = Clave::getClave();

if ($win == "true")
    $msj = "<h1>¡FELICIDADES!, ADIVINASTE LA CLAVE EN $intento JUGADAS.</h1>";
else
    $msj = "<h1>DEMASIADOS INTENTOS..., PRUEBA DE NUEVO</h1>";

$html_clave = Clave::getColoresClave($clave);
$informacion = $msj;
$informacion .= "<br/><h3>La clave era:</h3>";
$informacion .= $html_clave;
$informacion .= "<br/><h3>Tus jugadas:</h3>";
$informacion .= Plantilla::mostrarTodasJugadas();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Master Bind - Fin del Juego</title>
    <link rel="stylesheet" href="./css/estilo.css" type="text/css">
</head>
<body>

<fieldset class="informacion">
    <h2>INFORMACIÓN</h2>
    <fieldset>
        <legend>Resultado del juego:</legend>
        <?= $informacion ?? "" ?>
    </fieldset>
</fieldset>
<form action="index.php">
    <input type="submit" value="Volver al inicio">
</form>
</body>
</html>