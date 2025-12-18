<?php
class Racional
{
    // Atributos:
    private int $num;
    private int $den;

    // Métodos:
    public function __construct(string|int $num = 1, int $den = 1)
    {
        if (is_string($num)) {
            // Comprobar si es una fracción
            if (str_contains($num, "/")) {
                $numeros = explode("/", $num);
                $this->num = $numeros[0];
                $this->den = $numeros[1];
            } else {
                // Es un string, pero es un número entero (ej: "2")
                $this->num = $num;
                $this->den = 1; // Un entero es un racional con denominador 1
            }
        } else {
            $this->num = $num;
            $this->den = $den;
        }

    }

    public function __toString()
    {
        return "$this->num/$this->den";
    }

    // Operaciones:
    public function suma(\UD5_Objetos\ejercicios\calculadoraRacional\Racional $r2): \UD5_Objetos\ejercicios\calculadoraRacional\Racional{
        // Ej: 1/2 + 3/5

        $num =
            // 1 * 5
            ($this->num * $r2->den) +
            // 3 * 2
            ($r2->num * $this->den);

        // 2 * 5
        $den = $this->den * $r2->den;

        // 11 / 10
        return new \UD5_Objetos\ejercicios\calculadoraRacional\Racional($num, $den);
    }

    public function resta(\UD5_Objetos\ejercicios\calculadoraRacional\Racional $r2): \UD5_Objetos\ejercicios\calculadoraRacional\Racional {
        // Ej: 4/2 - 3/5

        $num =
            // 4 * 5
            ($this->num * $r2->den) -
            // 3 * 2
            ($r2->num * $this->den);

        // 2 * 5
        $den = $this->den * $r2->den;

        // 14 / 10
        return new \UD5_Objetos\ejercicios\calculadoraRacional\Racional($num, $den);
    }

    public function multiplicacion(\UD5_Objetos\ejercicios\calculadoraRacional\Racional $r2): \UD5_Objetos\ejercicios\calculadoraRacional\Racional {
        // Ej: 4/2 * 3/5

        // 4 * 3
        $num = $this->num * $r2->num;

        // 2 * 5
        $den = $this->den * $r2->den;

        // 12 / 10
        return new \UD5_Objetos\ejercicios\calculadoraRacional\Racional($num, $den);
    }

    public function division(\UD5_Objetos\ejercicios\calculadoraRacional\Racional $r2): \UD5_Objetos\ejercicios\calculadoraRacional\Racional {
        // Ej: 4/2 * 3/5

        // 4 * 5
        $num = $this->num * $r2->den;

        // 2 * 3
        $den = $this->den * $r2->num;

        // 20 / 6
        return new \UD5_Objetos\ejercicios\calculadoraRacional\Racional($num, $den);
    }

    // Simplificar:
    private function mcd($num, $den)
    {
        return $den == 0 ? $num : $this->mcd($den, $num % $den);
    }
    public function simplificar() : \UD5_Objetos\ejercicios\calculadoraRacional\Racional
    {
        $mcd = $this->mcd($this->num, $this->den);
        $num = $this->num/$mcd;
        $den = $this->den/$mcd;
        return new \UD5_Objetos\ejercicios\calculadoraRacional\Racional($num, $den);
    }

}

?>