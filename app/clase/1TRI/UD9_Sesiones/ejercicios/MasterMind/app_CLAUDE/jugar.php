<?php
require "controlador.php";
use MasterBind\Plantilla;
use MasterBind\Clave;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Juego Master Bind</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function cambia_color(numero) {
            color = document.getElementById("combinacion" + numero).value;
            elemento = document.getElementById("combinacion" + numero);
            elemento.className = color;
        }
    </script>
</head>
<body>
<div class="contenedorJugar">
    <div class="opciones">
        <h2>OPCIONES</h2>
        <fieldset>
            <legend>Acciones posibles</legend>
            <form action="jugar.php" method="POST">
                <?php $textoBoton = (isset($_SESSION['ver_clave']) && $_SESSION['ver_clave']) ? "Ocultar Clave" : "Mostrar Clave"; ?>
                <input type="submit" value="<?= $textoBoton ?>" name="submit">
                <input type="submit" value="Resetear la Clave" name="submit">
            </form>

            <?php if (isset($_SESSION['ver_clave']) && $_SESSION['ver_clave']): ?>
                <div style="margin-top:10px;">
                    <?= Clave::get_clave_html() ?>
                </div>
            <?php endif; ?>
        </fieldset>

        <fieldset>
            <legend>Menú jugar</legend>
            <form action="jugar.php" method="POST">
                <div class="grupo_select">
                    <h3>Selecciona 4 colores</h3>
                    <?= Plantilla::genera_formulario_juego() ?>
                </div>
                <input type="submit" value="Jugar" name="submit">
            </form>
        </fieldset>
    </div>

    <fieldset class="informacion">
        <h2>HISTÓRICO DE JUGADAS</h2>
        <div class="informacion-contenido">
            <?= $informacion ?: "<h3>Sin datos que mostrar</h3>" ?>
        </div>
    </fieldset>
</div>
</body>
</html>