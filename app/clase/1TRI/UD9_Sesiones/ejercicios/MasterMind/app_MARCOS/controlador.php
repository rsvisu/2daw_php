<?php

    require 'vendor/autoload.php';

use MasterBind\Modelo\Clave;
use MasterBind\Modelo\Jugada;

    session_start();

    $clave = Clave::obtener_clave();
    $mostrar_ocultar_clave = "Mostrar Clave";

    function evaluar_fin_juego(Jugada $jugada)
    {
        // Si ha acertado todas las posiciones, redirigimos a finJuego con el
        // parámetro de win en true
        if($jugada->get_posiciones_acertadas() == 4) {
            header("location:finJuego.php?win=true");
            exit;
        }
        // Si ya lleva más de 10 jugadas, redirigimos a finJuego con el
        // parámetro de win en false
        if(sizeof($_SESSION['jugadas']) >= 10) {
            header("location:finJuego.php?win=false");
            exit;
        }
    }

    $opcion = $_POST['submit'] ?? "";
    switch($opcion) {
        case "Mostrar Clave":
            $mostrar_ocultar_clave = "Ocultar Clave";
            $informacion = Clave::get_clave_html();
            break;
        case "Ocultar Clave":
            $mostrar_ocultar_clave = "Mostrar Clave";
            break;
        case "Resetear la Clave":
            session_destroy(); // Elimina todas las jugadas y clave previas
            session_start(); // Inicia una nueva sesión
            $clave = Clave::obtener_clave(); // Crea una nueva clave
            break;
        case "Jugar":
            // Nos aseguramos que aunque sea null sea un array
            $colores_jugados = $_POST['combinacion'] ?? [];
            // Validamos que la longitud es 4 y que no contiene ningún select vacío
            $es_jugada_valida = (count($colores_jugados) === 4 && !in_array("", $colores_jugados, true));

            if($es_jugada_valida) {
                $jugada = new Jugada($_POST['combinacion']);
                $_SESSION['jugadas'][] = serialize($jugada);
                evaluar_fin_juego($jugada);
                $informacion = Jugada::obtener_historico_jugadas();
            } else {
                $informacion = "<h2 style='color: red; text-align: center;'>ERROR: Debes seleccionar exactamente 4 colores sin dejar ningún campo vacío.</h2>";
                if (isset($_SESSION['jugadas']) && !empty($_SESSION['jugadas'])) {
                    $informacion .= Jugada::obtener_historico_jugadas();
                }
            }
            break;
        case "Empezar a jugar":
            break;
        default:
            if(!isset($_SESSION["usuario"])){
                header("location: ./index.php");
            }
            break;
    }

?>