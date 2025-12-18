<?php
    require 'vendor/autoload.php';

    use MasterBind\Modelo\Clave;
    use MasterBind\Modelo\Jugada;

    use Dotenv\Dotenv;

    try {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad(); // Carga $_ENV con tus credenciales de DB
    } catch (\Dotenv\Exception\InvalidPathException $e) {
        die("ERROR: No se pudo cargar el archivo .env.");
    }

    session_start();

    $jugadas = $_SESSION['jugadas'];
    $win = $_GET['win'] ?? "";
    $intento = sizeof ($_SESSION['jugadas']);
    if ($win)
        $msj="<h1>¡FELICIDADES!<br>Has ganado en la jugada nº: $intento <br>";
    else
        $msj="<h1> HAS AGOTADO TUS JUGADAS!!!!!";
    $html_clave = Clave::get_clave_html();
    $informacion = $msj;
    $informacion .= Jugada::obtener_historico_jugadas();

?>
<!--
RF1 Mostramos la pantalla según estilo (Opciones, Información, Jugada)
RF1.1 Mostrar opciones en Opciones
RF1.2 Mostrar menú de jugada
RF1.3 Mostrar información jugada
RF1 Generamos una clave y la guardamos en sesión  (usa un var_dump para verificar su funcionamiento )
RF2 Botón de reiniciar la clave (guardándola en sesión) (usa un var_dump para verificar su funcionamiento)
RF3 Leer jugada
RF4 evaluar jugada y obtener resultado (posiciones y colores=
RF6 Mostrar / ocular clave
RF7 Mostrar Jugadas
RF7.1 Mostrar Jugada actual
RF7.2 Mostrar Jugadas anteriores ordenadas


-->

<br />



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estilo.css" type="text/css">
</head>
<body>

    <fieldset class="informacion">
        <h2>INFORMACIÓN</h2>
        <fieldset>
            <legend>Sección de información</legend>
            <?= $informacion ?? ""?>
        </fieldset>
    </fieldset>
    <form action="index.php">
        <input type="submit" value="Volver Al index">
    </form>
</div>
</body>

</body>
</html>
