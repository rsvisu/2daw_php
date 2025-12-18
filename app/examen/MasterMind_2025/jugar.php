<?php

require_once 'vendor/autoload.php';
require "datos.php";

use Clases\Juego\Plantilla;
use Dotenv\Dotenv;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Master Bind - Jugando</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css"/>
    <!-- Script para cambiar el color del select -->
    <script type="text/javascript">
        function cambia_color(numero) {
            color = document.getElementById("combinacion" + numero).value;
            elemento = document.getElementById("combinacion" + numero);
            elemento.className = color;
        }
    </script>
</head>
<body>
<div class="contenedor">
    <?=$header?>
    
    <div class="jugar">
        <fieldset class="opciones">
            <legend>Opciones de juego</legend>
            <form action="jugar.php" method="POST">
                <input type="submit" value="<?= $textoBotonMostrarOcultarClave?>" name="submit"/>
                <input type="submit" value="Reiniciar" name="submit"/>
            </form>
        </fieldset>
        
        <fieldset class="menu">
            <legend>Menú juego</legend>
            <form action="jugar.php" method="POST">
                <?= Plantilla::mostrarFormularioJugada()?>
                <input type="submit" value="Jugar" name="submit">
            </form>
        </fieldset>
    </div>

    <fieldset class="jugadas">
        <legend>Información de jugadas</legend>
        <?= $msj ?? "<p>Selecciona 4 colores y haz tu primera jugada</p>" ?>
    </fieldset>
</div>


