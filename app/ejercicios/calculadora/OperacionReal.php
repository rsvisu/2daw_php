<?php

class OperacionReal extends Operacion
{
    // Atributos:
    private static array $operaciones = ["suma"=>"+","resta"=>"-","multiplicacion"=>"*","division"=>"/"];

    // Constructor:
    public function __construct($cadena)
    {
        parent::__construct($cadena, self::$operaciones);
    }

    // Métodos:
    public function operar() : float | null {
        switch ($this->operacion) {
            case self::$operaciones["suma"]:
                return $this->op1 + $this->op2;
                break;
            case self::$operaciones["resta"]:
                return $this->op1 - $this->op2;
                break;
            case self::$operaciones["multiplicacion"]:
                return $this->op1 * $this->op2;
                break;
            case self::$operaciones["division"]:
                return $this->op1 / $this->op2;
                break;
            default:
                return null;
        }
    }

    // To string:
    public function __toString() : string
    {
        return "$this->op1 $this->operacion $this->op2";
    }
}

?>