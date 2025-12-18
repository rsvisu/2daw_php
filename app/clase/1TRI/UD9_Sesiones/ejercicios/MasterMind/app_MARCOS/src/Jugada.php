<?php

    namespace MasterBind;

    use MasterBind\Clave;

    class Jugada
    {

        private $colores;
        private $posiciones_acertadas;
        private $colores_acertados;

        public function __construct(array $jugada)
        {
            $this->posiciones_acertadas = 0;
            $this->colores_acertados = 0;
            $this->colores = $jugada;
            $clave = Clave::obtener_clave();
            $this->evalua_jugada($clave);
        }

        public function get_posiciones_acertadas()
        {
            return $this->posiciones_acertadas;
        }

        public function get_colores_acertados()
        {
            return $this->colores_acertados;
        }

        private function evalua_jugada(array $clave)
        {
            $jugada = array_unique($this->colores);//!Quitamos los duplicados de la jugada

            foreach ($jugada as $color) {
                // Si el color se encuentra en la clave aunque no sea en la misma posición, sumamos
                if (in_array($color, $clave))
                    $this->colores_acertados++;
            }
            foreach ($this->colores as $posicion => $color)
                // Si el color está en la misma posición que en la clave, sumamos
                if ($color == $clave[$posicion])
                    $this->posiciones_acertadas++;
        }

        public function __toString(): string
        {
            $jugada_html = "";
            for ($n = 0; $n < $this->posiciones_acertadas; $n++)
                $jugada_html .= "<span class='negro'>$n</span>";
            for ($n = $this->posiciones_acertadas; $n < $this->colores_acertados; $n++)
                $jugada_html .= "<span class='blanco'>$n</span>";
            foreach ($this->colores as $color)
                $jugada_html .= "<span class='$color'>$color</span>";
            return $jugada_html;
        }

        public static function obtener_historico_jugadas(): string
        {
            $html = "";
            $jugadas = $_SESSION['jugadas'];
            foreach ($jugadas as $pos => $jugada) {
                // El unserialize las convierte otra vez en objetos Jugada, para el toString()
                $jugada = unserialize($jugada);
                $html .= " Jugada $pos: $jugada<br />";
            }
            return $html;
        }
    }
?>