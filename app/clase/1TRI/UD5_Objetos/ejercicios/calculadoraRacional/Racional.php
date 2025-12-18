<?php

namespace UD5_Objetos\ejercicios\calculadoraRacional;
class Racional
{
    // Atributos
    private int $num;
    private int $den;

    // Metodos
    public function __construct(string|int $num = 1, int $den = 1)
    {
        if (is_string($num)) {
            $numeros = explode("/", $num);
            $this->num = $numeros[0];
            $this->den = $numeros[1];
        } else {
            $this->num = $num;
            $this->den = $den;
        }

    }

    public function __toString()
    {
        return "$this->num/$this->den";
    }

    /*public function suma(Racional $r2): Racional{
        $num1 = $this->num;
        $den1 = $this->den;
        $num2 = $r2->num;
        $den2 = $r2->den;

        if ($den1 != $den2) {
            $num1 *= $den2;
            $num2 *= $den1;
            $den1 *= $den2;
        }
        return new Racional($num1 + $num2, $den1);
    }*/

    // Operaciones:
    public function suma(Racional $r2): Racional
    {
        // Ej: 1/2 + 3/5

        $num =
            // 1 * 5
            ($this->num * $r2->den) +
            // 3 * 2
            ($r2->num * $this->den);

        // 2 * 5
        $den = $this->den * $r2->den;

        // 11 / 10
        return new Racional($num, $den);
    }

    public function resta(Racional $r2): Racional
    {
        // Ej: 4/2 - 3/5

        $num =
            // 4 * 5
            ($this->num * $r2->den) -
            // 3 * 2
            ($r2->num * $this->den);

        // 2 * 5
        $den = $this->den * $r2->den;

        // 14 / 10
        return new Racional($num, $den);
    }

    public function multiplicacion(Racional $r2): Racional
    {
        // Ej: 4/2 * 3/5

        // 4 * 3
        $num = $this->num * $r2->num;

        // 2 * 5
        $den = $this->den * $r2->den;

        // 12 / 10
        return new Racional($num, $den);
    }

    public function division(Racional $r2): Racional
    {
        // Ej: 4/2 * 3/5

        // 4 * 5
        $num = $this->num * $r2->den;

        // 2 * 3
        $den = $this->den * $r2->num;

        // 20 / 6
        return new Racional($num, $den);
    }

    // Simplificar:
    private function mcd($num, $den)
    {
        return $den == 0 ? $num : $this->mcd($den, $num % $den);
    }

    public function simplificar(): Racional
    {
        $mcd = $this->mcd($this->num, $this->den);
        $num = $this->num / $mcd;
        $den = $this->den / $mcd;
        return new Racional($num, $den);
    }

}

?>