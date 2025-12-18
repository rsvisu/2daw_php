<?php
// cargo el autoload
require './../vendor/autoload.php';

use Dotenv\Dotenv;
use Clases\DB\BaseDatos;
use Class\View\Plantilla;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();


$con = BaseDatos::getInstance();


session_start();
$usuario = $_SESSION['usuario'] ?? null;

if (is_null($usuario)) {
    header("location:index.php");
    exit;
}
$tabla = $_SESSION['tabla'] ?? null;

$con = BaseDatos::getInstance();
$filas = $con->getContentTable($tabla);
$campos = $con->getFieldName($tabla);
$tabla_html = Plantilla::getContentTableToHtml($tabla, $campos, $filas);
$header_html = Plantilla::getHeader($usuario, "listado.php");


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


</head>
<body>
<?="$header_html"?>
<fieldset style="background: antiquewhite;width:70%;margin:10%">
    <legend>Tablas</legend>
    <form action="listado.php" method="POST">
        <?="$tabla_html"?>
    </form>
</fieldset>

</body>
</html>
