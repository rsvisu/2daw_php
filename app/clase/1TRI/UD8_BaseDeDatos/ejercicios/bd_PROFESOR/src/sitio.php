<?php
// cargo el autoload
require './../vendor/autoload.php';

use Dotenv\Dotenv;
use Clases\DB\BaseDatos;
use Class\View\Plantilla;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

session_start();
$usuario = $_SESSION['usuario'] ?? null;
if (is_null($usuario)) {
    header("location:index.php");
    exit;
}

$header_html = Plantilla::getHeader($usuario, "sitio.php");
$opcion = $_POST['submit'] ?? null;
switch ($opcion) {
    case "Logout":
        session_destroy();
        header("location:index.php");
        exit;
    case "producto":
        $_SESSION['tabla']="producto";
    case "familia":
        $_SESSION['tabla']=$_SESSION['tabla']??"familia";
    case "stock":
        $_SESSION['tabla']=$_SESSION['tabla']??"stock";
    case "usuarios":
        $_SESSION['tabla']=$_SESSION['tabla']??"usuarios";
    case "tienda":
        $_SESSION['tabla']=$_SESSION['tabla']??"tienda";
        header ("location:listado.php");
        exit;
    default:
}


$con = BaseDatos::getInstance();

if (isset($_POST['submit'])) {
    $tabla = $_POST['submit'];
    $filas = $con->getContentTable($tabla);
    $campos = $con->getFieldName($tabla);
    $tabla_html = Plantilla::getContentTableToHtml($tabla, $campos, $filas);
} else {
    $tablas = $con->getAllTables();
    $tabla_html = "";
    foreach ($tablas as $tabla) {
        $tabla_html .= "<input class='btn btn-primary' type='submit' name='submit' value='$tabla'>";
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body>
<header>
    <?= "$header_html" ?>
</header>
<fieldset style="background: antiquewhite;width:70%;margin:10%">
    <legend>Tablas</legend>
    <form action="sitio.php" method="POST">
        <?= "$tabla_html" ?>
    </form>
</fieldset>

</body>
</html>
