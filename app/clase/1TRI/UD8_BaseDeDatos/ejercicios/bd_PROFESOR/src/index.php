<?php
// cargo el autoload
require './../vendor/autoload.php';

use Dotenv\Dotenv;
use Clases\DB\BaseDatos;
use Class\View\Plantilla;
session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
$opcion = $_POST["submit"]??null;
$con =  BaseDatos::getInstance();

switch ($opcion) {
    case "Login":
        $nombre = $_POST["name"];
        $password = $_POST["password"];
        $msj = $con->validar_usuario($nombre, $password);

        if ($msj===true) {
            header("location:sitio.php");
            $_SESSION['usuario'] = $nombre;
        }

        //Loguearme
        break;
    case "Registrar":
        //Registrarme
        //Leer los datos
        $nombre = $_POST["name"];
        $password = $_POST["password"];
        $msj = $con->registrar($nombre, $password);
        if ($msj) {
            header("location:sitio.php");
            $_SESSION['usuario'] = $nombre;
        }


        break;
}







?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos de acceso</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="h-screen flex justify-center items-center">
<fieldset class="bg-yellow-200">
    <legend class="text-blue-800 text-2xl">Datos de acceso</legend>
    <form action="index.php" method="POST">
        <div class = "flex flex-row space-x-2 p-2">
        <label for="">Usuario</label>
        <input type="text" class="bg-white rounded-sm " name="name" id="">
        </div>
        <div class = "flex flex-row space-x-2 px-2">
        <label for="">Password</label>
        <input type="text" name="password" id="">
        </div>
        <div class="flex flex-row p-3 justify-end space-x-2 items-center">
            <input type="submit"  class="btn btn-sm btn-primary" value="Login" name="submit">
            <input type="submit"  class="btn btn-sm btn-primary" value="Registrar" name="submit">
        </div>

    </form>
    </fieldset>
<span class="text-sm text-red-400"> <?=$msj ??""?></span>

</body>
</html>


