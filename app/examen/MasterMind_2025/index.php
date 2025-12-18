<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Clases\DB\DB;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = DB::getInstance();
$msj = "";

// Si ya está logueado, redirigir a jugar
if(isset($_SESSION["usuario"])){
    header("location: jugar.php");
    exit;
}

$submit = $_POST["submit"] ?? null;
switch ($submit) {
    // Si es login:
    case "Login":
        $name = $_POST["name"];
        $password = $_POST["password"];

        $resultado = $database->validar_usuario($name, $password);

        if($resultado === true) {
            $_SESSION["usuario"] = $name;
            header("location: jugar.php");
            exit;
        } else {
            $msj = $resultado;
        }
        break;

    // Si es registrar:
    case "Register":
        $name = $_POST["name"];
        $password = $_POST["password"];

        $resultado = $database->registrar_usuario($name, $password);

        if($resultado === true){
            $_SESSION["usuario"] = $name;
            header("location: jugar.php");
            exit;
        } else {
            $msj = $resultado;
        }
        break;
        
    default:
        break;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Juego Master Bind</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
<div class="containerIndex">

    <div class="presentacion">
        <h2>DESCRIPCIÓN DEL JUEGO DE MASTER BIND</h2>
        <hr/>
        <ol>
            <li>Esta es una presentación personalizada del juego.</li>
            <li>El usuario deberá de adivinar una secuencia de 4 colores diferentes.</li>
            <li>Los colores se establecerán aleatoriamente de entre 10 colores preestablecidos.</li>
            <li>En total habrá 14 intentos para adivinar la clave.</li>
            <li>En cada jugada la app informará:
                <ul>
                    <li>Cuántos colores has acertado de la combinación</li>
                    <li>Cuántos de ellos están en la posición correcta.</li>
                </ul>
            <li>No se especificará cuáles son las posiciones acertadas en caso de acierto.</li>
        </ol>
        <hr/>
        <h2>Para comenzar debes previamente de loguearte </h2>
        <fieldset>
            <legend>Datos de acceso</legend>
            <form action="index.php" method="post">
                <div>
                    <label for="nombreUsuario">Nombre de usuario:</label>
                    <input type="text" id="nombreUsuario" name="name" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="submit" value="Login" name="submit">
                <input type="submit" value="Register" name="submit">
            </form>
        </fieldset>
    </div>
    <span class="error"><?=$msj??""?></span>
</div>
</body>
</html>
