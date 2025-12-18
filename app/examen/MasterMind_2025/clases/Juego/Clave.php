<?php
namespace Clases\Juego;

use Clases\Juego\Constantes;

class Clave
{
    /**
     * @return array 4 colores diferentes de la lista de colores disponibles
     */
    static private function generaClave(): array
    {
        $clave = [];
        
        // Obtenemos 4 indices únicos aleatorios de COLORES
        $indices_aleatorios = array_rand(Constantes::COLORES, 4);
        foreach ($indices_aleatorios as $indice) {
            $clave[] = Constantes::COLORES[$indice];
        }
        
        return $clave;
    }

    /**
     * @return array la clave
     * Si la clave existe en variable de sesión, la retorna, si no
     * genera una nueva y la guarda en variable de sesión
     */
    static public function getClave(): array
    {
        // Si ya existe la clave en sesión, la devolvemos
        if(isset($_SESSION['clave'])) {
            return $_SESSION['clave'];
        } else {
            // Si no existe, la generamos y guardamos
            $clave = self::generaClave();
            $_SESSION['clave'] = $clave;
            return $clave;
        }
    }

    /**
     * @return string
     * Retorna los colores de la clave
     */
    static public function getColoresClave(array $clave): string
    {
        $html = '<div class="clave-final">';
        foreach ($clave as $color){
            $html .= "<div class='$color'>$color</div>";
        }
        $html .= '</div>';
        return $html;
    }
}