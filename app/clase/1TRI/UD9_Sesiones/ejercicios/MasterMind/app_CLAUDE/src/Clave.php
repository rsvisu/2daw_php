<?php
namespace MasterBind;

/**
 * Clase Clave - Gestiona la clave secreta del juego
 *
 * Esta clase se encarga de generar y mantener la clave secreta
 * que el jugador debe adivinar. Usa métodos estáticos para
 * asegurar que la clave sea única por sesión.
 */
class Clave
{
    // Array con los 8 colores disponibles para el juego
    public const COLORES = ['Azul', 'Rojo', 'Naranja', 'Verde', 'Violeta', 'Amarillo', 'Marron', 'Rosa'];

    // Variable estática para almacenar la clave actual
    // Es estática porque queremos una sola clave por clase, no por objeto
    private static $clave = [];

    /**
     * Método principal para obtener la clave
     *
     * Implementa el patrón Singleton a través de sesiones:
     * - Si ya existe clave en sesión, la recupera
     * - Si no existe, genera una nueva y la guarda
     *
     * @return array La clave secreta de 4 colores
     */
    public static function obtener_clave()
    {
        // Lógica de persistencia - comprobar si ya tenemos clave en sesión
        if (isset($_SESSION['clave'])) {
            // Si ya existe, la cargamos desde la sesión
            self::$clave = $_SESSION['clave'];
        } else {
            // Si no existe, generamos una nueva
            self::genera_clave();
            // Y la guardamos en sesión para mantenerla entre peticiones
            $_SESSION['clave'] = self::$clave;
        }

        return self::$clave;
    }

    /**
     * Genera una nueva clave aleatoria de 4 colores únicos
     *
     * Usa array_rand para seleccionar 4 posiciones aleatorias
     * del array de colores disponibles, garantizando que no
     * se repitan colores en la misma clave.
     */
    private static function genera_clave()
    {
        // Reiniciar la clave
        self::$clave = [];
        // Obtener todos los colores disponibles
        $colores = self::COLORES;

        // Función clave: array_rand selecciona 4 índices aleatorios y ÚNICOS
        $posiciones = array_rand($colores, 4);

        // Recorrer las posiciones seleccionadas y crear la clave
        foreach ($posiciones as $posicion) {
            self::$clave[] = $colores[$posicion];
        }
    }

    /**
     * Genera HTML para mostrar la clave visualmente usando las clases CSS existentes
     *
     * @return string HTML con la representación visual de la clave
     */
    public static function get_clave_html()
    {
        $clave_html = "";

        // Recorrer cada color de la clave y usar las clases CSS existentes
        foreach (self::$clave as $color) {
            // Usar la clase Color_small que ya existe en el CSS
            $clave_html .= "<div class='Color_small {$color}'>" . substr($color, 0, 1) . "</div>";
        }

        return $clave_html;
    }

    /**
     * Método para obtener la clave como string simple (para debug o mostrar texto)
     *
     * @return string La clave como texto separado por comas
     */
    public static function get_clave_string()
    {
        return implode(', ', self::$clave);
    }
}