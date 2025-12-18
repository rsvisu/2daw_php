<?php
namespace Clases\Juego;

class Jugada
{
    private $jugada = [];
    private $posicionesAcertadas = 0;
    private $coloresAcertados = 0;

    /**
     * Jugada constructor.Crea una jugada (4 colores que el usuario a ejegido)
     */
    public function __construct(array $colores)
    {
        $this->jugada = $colores;
        $clave = Clave::getClave();
        $this->comparaJugada($clave);
    }

    /**
     * @param $clave
     * compara la clave con la jugada
     * Anota el resultado que son los colores acertados y de ellos cuantos
     * Están en la posiciòn correcta
     */
    public function comparaJugada($clave)
    {
        // Quitamos duplicados de la jugada para contar colores acertados
        $jugada_unica = array_unique($this->jugada);

        foreach ($jugada_unica as $color) {
            if (in_array($color, $clave))
                $this->coloresAcertados++;
        }

        // Contamos posiciones acertadas
        foreach ($this->jugada as $posicion => $color) {
            if ($color == $clave[$posicion])
                $this->posicionesAcertadas++;
        }
    }

    /**
     * @return array la jugada (colores)
     */
    public function getJugada(): array
    {
        return $this->jugada;
    }

    /**
     * @return int
     */
    public function getPosicionesAcertadas(): int
    {
        return $this->posicionesAcertadas;
    }

    /**
     * @return int
     */
    public function getColoresAcertados(): int
    {
        return $this->coloresAcertados;
    }

    /**
     * @return string Los colores de la jugada para incluirlos en html
     */
    public function getColoresJugada(): string
    {
        $html = "";
        
        // Mostramos redondeles negros para posiciones acertadas
        for ($n = 0; $n < $this->posicionesAcertadas; $n++)
            $html .= "<span class='negro'></span>";
        
        // Mostramos redondeles blancos para colores acertados (sin posición)
        for ($n = $this->posicionesAcertadas; $n < $this->coloresAcertados; $n++)
            $html .= "<span class='blanco'></span>";
        
        // Mostramos los colores de la jugada
        foreach ($this->jugada as $color)
            $html .= "<span class='$color'>$color</span>";
        
        return $html;
    }

    public static function objeto($objetoJugada): Jugada
    {
        return unserialize($objetoJugada);
    }
}