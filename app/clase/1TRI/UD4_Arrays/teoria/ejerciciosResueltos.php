<?php
echo "<h1>Arrays de notas:</h1>";
// Crear un array con 20 notas (0, 10);
// 1
$notas1 = [];
for ($i = 0; $i <= 20; $i++) {
    $notas1[] = rand(0,10);
}
var_dump($notas1);

// 2
$notas2 = array_fill(0, 20, rand(1, 10));
var_dump($notas2); // Aqui pone el mismo numero con todas

// 3
$notas3 = array_fill(0, 20, 0);
$inicializa = fn()=>rand(1,10);
$notas3 = array_map($inicializa, $notas3);
var_dump($notas3);

echo "<h1>Operaciones:</h1>";

// Media del array
/*$suma = 0;
$numElementos = count($notas3);
for ($i = 0; $i <= $numElementos; $i++) {
    $suma += $notas3[$i];
}*/
$suma = array_sum($notas3);
$numElementos = count($notas3);
$media = $suma / $numElementos;
echo "<h3>La media de las notas: $media.</h3>";



?>