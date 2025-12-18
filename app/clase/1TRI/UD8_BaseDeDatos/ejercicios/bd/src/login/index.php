<?php
// Configuración inicial.
require "../../vendor/autoload.php";

use Class\DataBase\BaseDatos;
use Class\View\Plantilla;

$con = BaseDatos::getInstance();

// Leo los datos:
$usuario = $_POST["usuario"] ?? null;
$contrasena = $_POST["contrasena"] ?? null;

// Opciones.
$opcion = $_POST["submit"] ?? null;
switch ($opcion) {
    case "Login":
        $res = $con->validarUsuario($usuario, $contrasena);
        if ($res === true) {
            session_start();
            $_SESSION["usuario"] = $usuario;
            header("location: sitio.php");
            exit();
        } else {
            $msj_exitoso = false;
            $msj = $res;
        }
        break;
    case "Registrarse":
        $res = $con->registrarse($usuario, $contrasena);
        if ($res === true) {
            $msj_exitoso = true;
            $msj = "Usuario '$usuario' registrado exitosamente!";
        } else {
            $msj_exitoso = false;
            $msj = $res;
        }
        break;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="h-screen flex justify-center items-center bg-gray-100">

<fieldset class="border p-4 rounded bg-white">
    <legend class="font-semibold">Datos de acceso:</legend>

    <form action="#" method="POST" class="flex flex-col gap-3">

        <label>
            Usuario:
            <input type="text" name="usuario" id="usuario" class="border p-1 rounded w-full">
        </label>

        <label>
            Contraseña:
            <input type="password" name="contrasena" id="contrasena" class="border p-1 rounded w-full">
        </label>

        <div class="flex gap-2 pt-2">
            <input type="submit" name="submit" value="Login" class="border rounded px-3 py-1 cursor-pointer">
            <input type="submit" name="submit" value="Registrarse" class="border rounded px-3 py-1 cursor-pointer">
        </div>
    </form>
    <?php if (isset($msj_exitoso)): ?>
        <?php if ($msj_exitoso): ?>
            <span class="text-em text-green-400"><?= $msj ?></span>
        <?php else: ?>
            <span class="text-em text-red-400"><?= $msj ?></span>
        <?php endif ?>
    <?php endif ?>
</fieldset>
</body>
</html>
