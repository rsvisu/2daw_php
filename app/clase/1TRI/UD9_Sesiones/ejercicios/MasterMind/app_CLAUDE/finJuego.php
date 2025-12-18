<?php
// Cargar autoload y clases
require 'vendor/autoload.php';
use MasterBind\Clave;
use MasterBind\Jugada;

session_start();

// Obtener datos de la sesión para mostrar información final
$jugadas = $_SESSION['jugadas'] ?? [];
$win = $_GET['win'] ?? "";
$intento = sizeof($_SESSION['jugadas']);

// Determinar el mensaje según el resultado
if ($win) {
    $msj = "<h1>¡FELICIDADES!</h1><br/>Has ganado en la jugada nº: $intento <br/>";
} else {
    $msj = "<h1>HAS AGOTADO TUS JUGADAS!!!!!</h1>";
}

// Obtener información final para mostrar
$html_clave = Clave::get_clave_html();
$informacion = $msj;
$informacion .= Jugada::obtener_historico_jugadas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fin del Juego</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
<div>
    <fieldset class="informacion">
        <h2>INFORMACIÓN</h2>
        <fieldset>
            <legend>Sección de información</legend>
            <?= $informacion ?>
        </fieldset>
    </fieldset>

    <!-- Formulario para volver a jugar -->
    <form action="index.php">
        <input type="submit" value="Volver Al index">
    </form>
</div>
</body>
</html>