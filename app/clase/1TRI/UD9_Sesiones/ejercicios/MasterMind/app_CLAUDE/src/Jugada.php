<?php
namespace MasterBind;

/**
 * Clase Jugada - Evalúa las jugadas del usuario
 *
 * Esta es la clase más compleja del juego. Se encarga de:
 * - Almacenar la jugada del usuario
 * - Compararla con la clave secreta
 * - Calcular aciertos de posición y color
 * - Generar representación HTML de los resultados
 */
class Jugada
{
    private $colores;              // Array con los 4 colores elegidos por el usuario
    private $posiciones_acertadas; // Cuántas posiciones exactas ha acertado
    private $colores_acertados;    // Cuántos colores están en la clave (aunque no en posición correcta)

    /**
     * Constructor de la clase
     *
     * @param array $jugada Array con los 4 colores seleccionados por el usuario
     */
    public function __construct(array $jugada)
    {
        // Inicializar contadores a 0
        $this->posiciones_acertadas = 0;
        $this->colores_acertados = 0;
        $this->colores = $jugada;

        // Obtener la clave actual y evaluar inmediatamente
        $clave = Clave::obtener_clave();
        $this->evalua_jugada($clave);
    }

    /**
     * Método principal que evalúa la jugada del usuario
     *
     * Algoritmo de evaluación:
     * 1. Primero cuenta posiciones exactas (color y posición correctos)
     * 2. Luego cuenta colores que están en la clave pero en posición incorrecta
     *
     * @param array $clave La clave secreta a comparar
     */
    private function evalua_jugada(array $clave)
    {
        // Crear copia de la jugada para eliminar duplicados al buscar colores
        $jugada = array_unique($this->colores); // Quitamos duplicados de la jugada

        // PASO 1: Buscar colores que están en la clave (aunque no estén en posición correcta)
        foreach ($jugada as $color) {
            // Si el color se encuentra en la clave aunque no sea en la misma posición, sumamos
            if (in_array($color, $clave)) {
                $this->colores_acertados++;
            }
        }

        // PASO 2: Buscar posiciones exactas (mismo color en misma posición)
        foreach ($this->colores as $posicion => $color) {
            // Si el color está en la misma posición que en la clave, sumamos
            if ($color == $clave[$posicion]) {
                $this->posiciones_acertadas++;
            }
        }
    }

    /**
     * Getter para posiciones acertadas
     * @return int Número de posiciones exactas acertadas
     */
    public function get_posiciones_acertadas()
    {
        return $this->posiciones_acertadas;
    }

    /**
     * Getter para colores acertados
     * @return int Número de colores que están en la clave
     */
    public function get_colores_acertados()
    {
        return $this->colores_acertados;
    }

    /**
     * Genera representación visual HTML de la jugada
     *
     * Crea una representación visual que muestra:
     * - Círculos negros para posiciones exactas
     * - Círculos blancos para colores correctos en posición incorrecta
     * - Los colores elegidos por el usuario
     *
     * @return string HTML de la jugada
     */
    public function __toString(): string
    {
        $jugada_html = "<div>";

        // Mostrar los colores elegidos por el usuario
        $jugada_html .= "<strong>Jugada:</strong> ";
        foreach ($this->colores as $color) {
            $jugada_html .= "<span class='Color_small {$color}'>" . substr($color, 0, 1) . "</span>";
        }

        $jugada_html .= "<br/><strong>Resultado:</strong> ";

        // Mostrar posiciones acertadas (círculos negros)
        for ($i = 0; $i < $this->posiciones_acertadas; $i++) {
            $jugada_html .= "<span class='negro'>●</span>";
        }

        // Mostrar colores acertados pero en posición incorrecta (círculos blancos)
        for ($i = $this->posiciones_acertadas; $i < $this->colores_acertados; $i++) {
            $jugada_html .= "<span class='blanco'>○</span>";
        }

        $jugada_html .= " | Posiciones: {$this->posiciones_acertadas} | Colores: {$this->colores_acertados}";
        $jugada_html .= "</div><hr/>";

        return $jugada_html;
    }

    /**
     * Método estático para obtener historial de jugadas
     *
     * Recupera todas las jugadas almacenadas en la sesión
     * y las convierte en HTML para mostrar el historial completo.
     *
     * @return string HTML con todas las jugadas anteriores
     */
    public static function obtener_historico_jugadas(): string
    {
        $html = "";

        // Verificar si existen jugadas en la sesión
        $jugadas = $_SESSION['jugadas'] ?? [];

        foreach ($jugadas as $pos => $jugada) {
            // El unserialize convierte otra vez en objetos Jugada, para el toString()
            $jugada = unserialize($jugada);
            $html .= "Jugada " . ($pos + 1) . ": " . $jugada . "<br/>";
        }

        return $html;
    }
}
