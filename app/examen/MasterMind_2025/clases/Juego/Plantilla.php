<?php

namespace Clases\Juego;

class Plantilla
{
    public static function html_logout(string $usuario): string
    {
        $html = '<div class="header">';
        $html .= '<h2 class="titulo">MASTER BIND</h2>';
        $html .= '<form action="jugar.php" method="POST" class="logout-form">';
        $html .= '<span class="usuario">Usuario: ' . $usuario . '</span>';
        $html .= '<input type="submit" value="Cerrar Sesión" name="submit" class="logout-btn"/>';
        $html .= '</form>';
        $html .= '</div>';
        return $html;
    }

    /**
     * @return string formulario con los 4 select para las jugadas
     */
    public static function mostrarFormularioJugada(): string
    {
        $html = "";
        $colores = Constantes::COLORES;
        
        // Obtenemos la última jugada si existe para mantener los colores
        $ultima_jugada = [];
        if(isset($_SESSION['jugadas']) && !empty($_SESSION['jugadas'])) {
            $ultima = end($_SESSION['jugadas']);
            $ultima_obj = Jugada::objeto($ultima);
            $ultima_jugada = $ultima_obj->getJugada();
        }

        // Generamos 4 select
        for($n = 0; $n < 4; $n++) {
            $color_seleccionado = $ultima_jugada[$n] ?? '';
            $html .= "<select name='combinacion[]' id='combinacion$n' class='$color_seleccionado' onchange='cambia_color($n)'>";
            
            if(empty($color_seleccionado)) {
                $html .= "<option value='' disabled selected>-- Color " . ($n + 1) . " --</option>";
            }

            foreach ($colores as $color) {
                $selected = ($color === $color_seleccionado) ? "selected" : "";
                $html .= "<option class='$color' value='$color' $selected>$color</option>";
            }

            $html .= "</select>";
        }
        return $html;
    }

    /**
     * @param array $arrayColores
     * @return string La clave
     */
    public static function mostrarClave(array $arrayColores): string
    {
        return Clave::getColoresClave($arrayColores);
    }

    /**
     * @return string
     * Tengo todas las jugadas en la variable de sesión
     * La última que tenga es la actual
     */
    public static function mostrarJugadas(): string
    {
        if(!isset($_SESSION['jugadas']) || empty($_SESSION['jugadas'])) {
            return "<p>¡Haz tu primera jugada!</p>";
        }

        $jugadas = self::obtenerJugadas();
        return self::obtenerDescripcionJugadas($jugadas);
    }

    /**
     * @return array obtiene todas las jugadas
     */
    private static function obtenerJugadas(): array
    {
        $jugadas = [];
        if(isset($_SESSION['jugadas'])) {
            foreach ($_SESSION['jugadas'] as $jugada_serializada) {
                $jugadas[] = Jugada::objeto($jugada_serializada);
            }
        }
        return $jugadas;
    }

    /**
     * @return string todas las jugadas
     *
     */
    public static function mostrarTodasJugadas(): string
    {
        return self::mostrarJugadas();
    }

    /**
     * @param array $jugadas
     * @return string
     */
    private static function obtenerDescripcionJugadas(array $jugadas): string
    {
        $html = "";
        foreach ($jugadas as $num => $jugada) {
            $html .= "<div class='jugada'>";
            $html .= "<span class='jugadaNumero'>Jugada " . ($num + 1) . ": </span>";
            $html .= "<span class='jugadaRedondeles'>";
            
            // Redondeles negros y blancos
            for ($i = 0; $i < $jugada->getPosicionesAcertadas(); $i++)
                $html .= "<span class='negro'></span>";
            for ($i = $jugada->getPosicionesAcertadas(); $i < $jugada->getColoresAcertados(); $i++)
                $html .= "<span class='blanco'></span>";
            
            $html .= "</span>";
            $html .= "<span class='jugadaColores'>";
            
            // Colores de la jugada
            foreach ($jugada->getJugada() as $color)
                $html .= "<div class='$color'>$color</div>";
            
            $html .= "</span>";
            $html .= "</div>";
        }
        return $html;
    }
}