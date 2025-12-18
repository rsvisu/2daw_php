<?php

abstract class Operacion
{
    // Atributos
    protected $op1;
    protected $operacion;
    protected $op2;

    // Constructor:
    protected function __construct($cadena, $operaciones)
    {
        // Recorreremos los operadores posibles.
        foreach ($operaciones as $operacion) {
            // Comprobamos si la cadena contiene el operador actual.
            if (str_contains($cadena, $operacion)) {
                $cadenaSeparada = explode($operacion, $cadena);

                // Si la cadena contiene más de un operador o no contiene
                // un segundo número paramos la ejecución.
                if (count($cadenaSeparada) != 2) {
                    break;
                }

                $this->op1 = $cadenaSeparada[0];
                $this->operacion = $operacion;
                $this->op2 = $cadenaSeparada[1];
            }
        }

        // Si no coincide ningún operador o no cumple las condiciones
        // los atributos se quedan en null.
    }

    // Getters
    public function getOp1(): string
    {
        return $this->op1;
    }

    public function getOperacion(): mixed
    {
        return $this->operacion;
    }

    public function getOp2(): string
    {
        return $this->op2;
    }

    // Métodos estáticos:

    // Devuelve si la cadena es una operación de racionales,
    // de reales o no es valida.
    const REAL = 1;
    const RACIONAL = 2;
    const ERROR = 3;
    public static function tipoOperacion(string $cadena)
    {
        // Comprobamos si es una operacion real.
        $real = "[0-9]+(?:\.[0-9]+)?";
        $entero = "[0-9]+";
        $racional = "[0-9]+/[0-9]+";
        $operadorReal = "[\+\-\*\/]";
        $operadorRacional = "[\+\-\*\:]";

        $operacionReal = "^$real$operadorReal$real$";

        if (preg_match("#$operacionReal#", $cadena)) {
            return self::REAL;
        }

        // Comprobamos si es una operacion racional.
        $operacionRacional1 = "^$racional$operadorRacional$racional$";
        $operacionRacional2 = "^$racional$operadorRacional$entero$";
        $operacionRacional3 = "^$entero$operadorRacional$racional$";

        if (
            preg_match("#$operacionRacional1#", $cadena) ||
            preg_match("#$operacionRacional2#", $cadena) ||
            preg_match("#$operacionRacional3#", $cadena)
        ) {
            return self::RACIONAL;
        }

        // En cualquier otro caso es error.
        return self::ERROR;
    }

    // Métodos abstractos:

    // Función para operar y devolver el resultado.
    protected abstract function operar();


}

?>
