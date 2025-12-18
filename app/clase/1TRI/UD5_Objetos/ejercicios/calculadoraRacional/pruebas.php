<?php

use UD5_Objetos\ejercicios\calculadoraRacional\Racional;

require_once("Racional.php");

echo "<h1>To string:</h1>";
$r1 = new Racional(5,7); // 5/7
echo "Valor de r1: $r1.<br>";

$r2 = new Racional(); // 1/1
echo "Valor de r2: $r2.<br>";

$r3 = new Racional(25); // 25/1
echo "Valor de r3: $r3.<br>";

$r4 = new Racional(25); // 25/1
echo "Valor de r4: $r4.<br>";

$r5 = new Racional("8/7"); // 8/7
echo "Valor de r5: $r5.<br>";

// Suma
echo "<h1>Sumas:</h1>";
$r6 = new Racional(1,2);
$r7 = new Racional(3,5);
$suma = $r6->suma($r7);
echo "$r6 + $r7: $suma<br>";
?>