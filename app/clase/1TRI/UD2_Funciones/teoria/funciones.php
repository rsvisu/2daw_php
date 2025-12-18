<?php

echo "<h2>Ejemplo 1:</h2>";
function mayor(int|string $arg1, int|string $arg2): int|string
{
    if (is_string($arg1)) {
        $resultado = match ($arg1 <=> $arg2) {
            1 => $arg1,
            -1 => $arg2,
            0 => $arg1,
        };
    } else {
        $resultado = $arg1 > $arg2 ? $arg1 : $arg2;
    }
    return $resultado;
}

$a1 = mayor("Hola que tal", "Hola");
$b1 = mayor(5, 2);

echo $a1;
echo "<br>";
echo $b1;

echo "<h2>Ejemplo 2:</h2>";
function racional(int|string|null $num=1, int|null $den=1) : string {

    if (is_string($num)) {
        $numeros = explode("/", $num);
        $num = $numeros[0];
        $den = $numeros[1];
    }

    return "$num/$den";
}

$a2 = racional(1,6); // 1/6
$b2 = racional(20); // 20/1
$c2 = racional("7/8"); // 7/8
$d2 = racional(); // 1/1

echo $a2;
echo "<br>";
echo $b2;
echo "<br>";
echo $c2;
echo "<br>";
echo $d2;
echo "<br>";

?>