<?php
class ExpresionRegular
{
    public static function validar($patron, $cadena)
    {
        return preg_match($patron, $cadena);
    }
}

?>