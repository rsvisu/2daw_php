<?php
// Cargar autoload de Composer para las clases
require 'vendor/autoload.php';

// Importar las clases que vamos a usar
use MasterBind\Clave;
use MasterBind\Jugada;
use MasterBind\Plantilla;

// Iniciar sesión para mantener estado entre peticiones
session_start();

/**
 * Función para evaluar si el juego ha terminado
 *
 * El juego termina en dos casos:
 * 1. El jugador acierta las 4 posiciones (gana)
 * 2. El jugador supera las 10 jugadas (pierde)
 *
 * @param Jugada $jugada La jugada actual del usuario
 */
function evaluar_fin_juego(Jugada $jugada)
{
    // Si ha acertado todas las posiciones, redirigimos a finJuego con el parámetro de win en true
    if ($jugada->get_posiciones_acertadas() == 4) {
        $win = true;
        header("Location: finJuego.php?win=$win");
        exit;
    }

    // Si ya lleva más de 10 jugadas, redirigimos a finJuego con el parámetro de win en false
    if (sizeof($_SESSION['jugadas']) >= 10) {
        $win = false;
        header("Location: finJuego.php?win=$win");
        exit;
    }
}

// Obtener la acción del formulario (qué botón se pulsó)
$opcion = $_POST['submit'] ?? "";

// Switch principal que maneja todas las acciones posibles del juego
switch ($opcion) {
    case "Mostrar Clave":
        // Cambiar el estado para mostrar la clave en la interfaz
        $mostrar_ocultar_clave = "Ocultar Clave";
        // Mostrar la clave secreta usando el método HTML
        $informacion = "<h3>Clave secreta:</h3><p>" . Clave::get_clave_string() . "</p>" . Clave::get_clave_html();
        break;

    case "Ocultar Clave":
        // Cambiar el estado para ocultar la clave
        $mostrar_ocultar_clave = "Mostrar Clave";
        $informacion = "<h3>Clave oculta</h3>";
        break;

    case "Resetear la Clave":
        // Limpiar toda la sesión y empezar de nuevo
        session_destroy(); // Elimina todas las jugadas y clave previas
        session_start(); // Inicia una nueva sesión
        $clave = Clave::obtener_clave(); // Crea una nueva clave
        $informacion = "<h3>Nueva partida iniciada</h3>";
        $mostrar_ocultar_clave = "Mostrar Clave"; // Reset del botón
        break;

    case "Jugar":
        // Verificar que se hayan seleccionado los 4 colores
        if (!isset($_POST['combinacion']) || count($_POST['combinacion']) != 4) {
            $informacion = "<h3 class='error'>Error: Debes seleccionar 4 colores</h3>";
            break;
        }

        // Verificar que no haya colores vacíos
        foreach ($_POST['combinacion'] as $color) {
            if (empty($color)) {
                $informacion = "<h3 class='error'>Error: Debes seleccionar todos los colores</h3>";
                break 2; // Sale del foreach y del switch
            }
        }

        // Procesar la jugada del usuario
        $jugada = new Jugada($_POST['combinacion']);

        // Guardar la jugada en la sesión (serializamos el objeto)
        $_SESSION['jugadas'][] = serialize($jugada);

        // Comprobar si el juego ha terminado
        evaluar_fin_juego($jugada);

        // Si llegamos aquí, el juego continúa - obtener historial para mostrar
        $informacion = "<h3>Historial de jugadas:</h3>" . Jugada::obtener_historico_jugadas();
        break;

    default:
        // Inicializar el juego por primera vez
        Clave::obtener_clave();
        $informacion = "<h3>¡Bienvenido! Selecciona tu primera combinación</h3>";
        $mostrar_ocultar_clave = "Mostrar Clave";
        break;
}
?>