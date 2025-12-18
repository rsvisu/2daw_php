<?php
// ¡Paso 1: Inicia la sesión! Debe ser lo primero.
session_start();

// El resto de tus inclusiones y configuración
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use MasterBind\Database\Database;

$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();

$database = Database::getInstance();

$msj = "";

$submit = $_POST["submit"] ?? null;
switch ($submit) {
    case "Login":
        $name = $_POST["name"];
        $password = $_POST["password"];

        $resultado = $database->login($name, $password);

        if($resultado === true) {
            $_SESSION["usuario"] = $name;
            header("location: index.php");
            exit;
        }

        break;

    case "Register":
        $name = $_POST["name"];
        $password = $_POST["password"];

        $msj = $database->registrarse($name, $password);

        if($msj){
            $_SESSION["usuario"] = $name;
            header("location: index.php");
            exit;
        }

        break;
    default:
        break;
}
// Si no hay redirección, el script continuará y mostrará el HTML.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <script
            src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body class="h-scrren flex justify-center items-center">
<fieldset class="bg-yellow-200">
    <legend class="text-blue-800 text-2xl">Datos de acceso</legend>

    <form action="login.php" method="post">
        <div>
            <label for="">Usuario</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Password</label>
            <input type="text" name="password">
        </div>
        <div>
            <input type="submit" name="submit" value="Login">
            <input type="submit" name="submit" value="Register">
        </div>
    </form>
</fieldset>
<span class="text-sm text-red-400"><?= $msj ?? '' ?></span>
</body>
</html>