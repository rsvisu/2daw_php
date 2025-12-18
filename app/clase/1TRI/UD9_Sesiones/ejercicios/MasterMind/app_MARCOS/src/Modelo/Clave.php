<?php

namespace MasterBind\Modelo;

class Clave {

    // Colores disponibles
    public const COLORES = ['Azul', 'Rojo', 'Naranja', 'Verde', 'Violeta', 'Amarillo', 'Marron', 'Rosa'];

    // Almacena la clave secreta actual
    private static $clave = [];

    public static function obtener_clave() {
        // Lógica de Persistencia
        if(isset($_SESSION['clave'])) {
            self::$clave = $_SESSION['clave']; // Si ya existe, la carga desde la sesión
        } else {
            // Lógica de Generación
            self::genera_clave();
            $_SESSION['clave'] = self::$clave;
        }
        return self::$clave;
    }

    private static function genera_clave() {
        self::$clave = [];
        $colores = self::COLORES;

        // Función clave: array_rand selecciona 4 índices aleatorios y ÚNICOS
        $posiciones = array_rand($colores, 4);
        foreach ($posiciones as $posicion) {
            self::$clave[] = $colores[$posicion];
        }
    }

    // En la clase MasterBind\Clave
    public static function get_clave_html() {
        $clave_html = '<span class="clave-final">'; // Contenedor para la clave
        foreach (self::$clave as $color){
            // Añadimos TAMAÑO, DISPOSICIÓN y un BORDE para hacer los colores visibles
            $clave_html .= "<div class='".$color."'>$color</div>";
        }
        $clave_html .= '</span>';
        return $clave_html;
    }



}

?>