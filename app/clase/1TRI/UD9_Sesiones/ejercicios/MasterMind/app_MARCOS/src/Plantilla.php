<?php

    namespace MasterBind;

    use MasterBind\Clave;

    class Plantilla {

        static public function genera_formulario_juego() : string {
            $html_select = "";

            // 1. Obtener lista de colores
            $colores = Clave::COLORES;

            // 2. Bucle para generar 4 select
            for($n = 0; $n < 4; $n++) {
                // MUY IMPORTANTE: Se usa 'combinacion[]' para que PHP lo reciba como array
                $html_select .= "<select name='combinacion[]'>";

                // Opción por defecto (disabled selected)
                $html_select .= "<option value='' disabled selected>-- Color " . ($n + 1) . " --</option>";

                // 3. Loop secundario: Agregar todas las opciones de color
                foreach ($colores as $color) {
                    // El 'value' es lo que se enviará en el POST, y la 'class' es para CSS
                    $html_select .= "<option class='$color' value='$color'> $color </option> ";
                }

                // Cierre del <select>
                $html_select .= "</select>";
            }
            return $html_select;
        }

    }

?>