<?php
namespace MasterBind;

/**
 * Clase Plantilla - Genera elementos HTML para el juego
 *
 * Esta clase separa la lógica de presentación del resto del código.
 * Se encarga de generar formularios y elementos HTML necesarios
 * para la interfaz del usuario.
 */
class Plantilla
{
    /**
     * Genera el formulario con 4 selectores de colores
     *
     * Método estático que crea 4 elementos <select> para que
     * el usuario pueda elegir su combinación de colores.
     * Cada select tiene eventos JavaScript para cambiar su apariencia.
     *
     * @return string HTML del formulario completo
     */
    static public function genera_formulario_juego(): string
    {
        $html_select = "";

        // 1. Obtener lista de colores disponibles
        $colores = Clave::COLORES;

        // 2. Bucle para generar 4 selectores
        for ($i = 0; $i < 4; $i++) {
            // MUY IMPORTANTE: se usa 'combinacion[]' para que PHP lo reciba como array
            $html_select .= "<select name='combinacion[]' id='combinacion{$i}' onchange='cambia_color({$i})'>";

            // Opción por defecto (disabled selected)
            $html_select .= "<option value='' disabled selected>Color</option>";

            // 3. Loop secundario: Agregar todas las opciones de color
            foreach ($colores as $color) {
                // El 'value' es lo que se enviará en el POST, y la 'class' es para CSS
                $html_select .= "<option class='{$color}' value='{$color}'>{$color}</option>";
            }

            // Cierre del <select>
            $html_select .= "</select>";
        }

        return $html_select;
    }
}
