<?php

use UD5_Objetos\ejercicios\calculadoraRacional\Racional;

require_once "Racional.php";
require_once "Operacion.php";
class OperacionRacional extends Operacion
{
    // Atributos:
    private static array $operaciones = ["suma"=>"+","resta"=>"-","multiplicacion"=>"*","division"=>":"];

    // Constructor:
    public function __construct($cadena)
    {
        parent::__construct($cadena, self::$operaciones);
        $this->op1 = new Racional($this->op1);
        $this->op2 = new Racional($this->op2);
    }

    // Métodos:
    public function operar() : Racional | null {
        switch ($this->operacion) {
            case self::$operaciones["suma"]:
                return $this->op1->suma($this->op2);
                break;
            case self::$operaciones["resta"]:
                return $this->op1->resta($this->op2);
                break;
            case self::$operaciones["multiplicacion"]:
                return $this->op1->multiplicacion($this->op2);
                break;
            case self::$operaciones["division"]:
                return $this->op1->division($this->op2);
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