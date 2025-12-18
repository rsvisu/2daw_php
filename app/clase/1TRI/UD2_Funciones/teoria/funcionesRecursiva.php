<?php

// FACTORIAL

echo "<h1>Factorial: </h1>";

// Funcion
function factorial (int $num) : int {
    if ($num == 0) {
        return 1;
    }
    return factorial($num-1) * $num;
}

$num = 3;
$n = factorial($num);
echo "<h3>El factorial de $num es: $n.</h3>";

// Variable de funcion
$varFactorial = function (int $num) use (&$varFactorial): int {
    if ($num == 0) {
        return 1;
    }
    return $varFactorial($num-1) * $num;
};

$num = 5;
$n = $varFactorial($num);
echo "<h3>El factorial de $num es: $n.</h3>";

// METODO DE EUCLIDES
//Dados dos números quiero obtener el mcd de ellos usando el metodo de Euclides
//Este métdodo algoritmicamente indica que hay que relizar sucesivas restar de un número y otro
//El resultado se vuelve a restar con el menor de los números
//Al final termino con un uno o con un cero
//Si es cero el último número es el mc

echo "<h1>Metodo de Euclides:</h1>";

$num1 = 10;
$num2 = 5;

// Funcion tradicional

function  mcdTradicional(int $num1, int $num2): int
{

    if ($num1 >= $num2) {
        $max = $num1;
        $min = $num2;
    } else {
        $max = $num2;
        $min = $num1;
    }

    while (true) {

        if ($max == $min) {
            return $max;
        }
        if ($max == 0) {
            return $min;
        }
        if ($min == 0) {
            return $max;
        }

        $resta = $max - $min;
        if ($min >= $resta) {
            $max = $min;
            $min = $resta;
        } else {
            $max = $resta;
        }

    }
}

$mcd = mcdTradicional($num1, $num2);
echo "<h3>El mcd de $num1 y $num2 es: $mcd.</h3>";

//En función flecha

//Función recursiva

//En variable

?>