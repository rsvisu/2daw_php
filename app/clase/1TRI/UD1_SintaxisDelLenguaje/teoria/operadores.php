<?php

// Potencia
echo "<h1>Potencias:</h1>";

$a = 2 ** 10;     // Mejor el operador que la funcion.
$b = pow(2, 10);

echo "a: $a";
echo "<br>";
echo "b: $b";

echo "<h2>10 primeras potencias de 2:</h2>";

for ($i = 0; $i < 10; ++$i) {
    echo 2 ** $i;
    echo "<br>";
}

// Pre y post incremento
echo "<h1>Pre y post incremento:</h1>";

$c = 5;
$d = $c++;

echo "c: $c";
echo "<br>";
echo "d: $d";

// Asignacion por referencia
echo "<h1>Asignacion por referencia:</h1>";

$nombre = "Maria";
$alias = &$nombre;

$alias = "Daniel";
echo "Valor de nombre: $nombre.";

// Comparacion binaria
echo "<h1>Comparacion binaria:</h1>";

$e = 55;
$f = 50;

echo "e:" . decbin($e);
echo "<br>";
echo "f:" . decbin($f);
echo "<br>";
echo "r:" . decbin($e & $f);

echo "<h2>Direccion de red a partir de la ip y mascara:</h2>";
echo "<a href='red.php'>Enlace</a>";
?>