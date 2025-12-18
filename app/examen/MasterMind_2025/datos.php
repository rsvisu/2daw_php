<?php
require 'vendor/autoload.php';

use Clases\Juego\Clave;
use Clases\Juego\Jugada;
use Clases\Juego\Plantilla;
use Clases\DB\DB;
use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    die("ERROR: No se pudo cargar el archivo .env.");
}

session_start();

// Verificar usuario logueado
$usuario = $_SESSION["usuario"] ?? null;
if(is_null($usuario)){
    header("location: index.php");
    exit;
}

// Obtener la clave
$clave = Clave::getClave();
$textoBotonMostrarOcultarClave = "Mostrar Clave";
$header = Plantilla::html_logout($usuario);
$msj = "";

// Función auxiliar para evaluar fin de juego
function evaluar_fin_juego(Jugada $jugada)
{
    if($jugada->getPosicionesAcertadas() == 4) {
        header("location:finJuego.php?win=true");
        exit;
    }
    if(sizeof($_SESSION['jugadas']) >= 14) {
        header("location:finJuego.php?win=false");
        exit;
    }
}

// Procesar acciones
$opcion = $_POST['submit'] ?? "";
switch($opcion) {
    case "Mostrar Clave":
        $textoBotonMostrarOcultarClave = "Ocultar Clave";
        $msj = Plantilla::mostrarClave($clave);
        $msj .= Plantilla::mostrarJugadas();
        break;
        
    case "Ocultar Clave":
        $textoBotonMostrarOcultarClave = "Mostrar Clave";
        $msj = Plantilla::mostrarJugadas();
        break;
        
    case "Reiniciar":
        // Guardamos el usuario antes de destruir sesión
        $usuario_temp = $_SESSION["usuario"];
        session_destroy();
        session_start();
        $_SESSION["usuario"] = $usuario_temp;
        $clave = Clave::getClave();
        $msj = "<p>Juego reiniciado. ¡Buena suerte!</p>";
        break;
        
    case "Jugar":
        $colores_jugados = $_POST['combinacion'] ?? [];
        $es_jugada_valida = (count($colores_jugados) === 4 && !in_array("", $colores_jugados, true));

        if($es_jugada_valida) {
            $jugada = new Jugada($colores_jugados);
            $_SESSION['jugadas'][] = serialize($jugada);
            evaluar_fin_juego($jugada);
            $msj = Plantilla::mostrarJugadas();
        } else {
            $msj = "<h3 style='color: red;'>ERROR: Debes seleccionar exactamente 4 colores.</h3>";
            if (isset($_SESSION['jugadas']) && !empty($_SESSION['jugadas'])) {
                $msj .= Plantilla::mostrarJugadas();
            }
        }
        break;
        
    case "Cerrar Sesión":
        session_destroy();
        header("location: index.php");
        exit;
        
    default:
        $msj = Plantilla::mostrarJugadas();
        break;
}
?>
