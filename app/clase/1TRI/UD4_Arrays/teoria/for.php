<?php
echo "<h2>For:</h2>";
// Array aleatorio de notas
$notas = array_fill(0, 20, 0);
$inicializa = fn()=>rand(1,10);
$notas = array_map($inicializa, $notas);

// For normal:
$suma = 0;
$numElementos = count($notas);
for ($i = 0; $i < $numElementos; $i++) {
    $suma += $notas[$i];
}
$media = $suma / $numElementos;
echo "Media for: $media";

// No recomendado porque puede fallar en casos como este:
echo "<hr>";
echo "<h4>Error intencional for normal:</h4>";

$notas[40] = 100;

$suma = 0;
$numElementos = count($notas);
for ($i = 0; $i < $numElementos; $i++) {
    $suma += $notas[$i];
}
echo "<hr>";

// Es mejor usar foreach:
echo "<h2>Foreach:</h2>";
$numElementos = count($notas);
$suma = 0;
foreach ($notas as $key => /*& (se puede usar el valor por referencia para modificar los valores)*/$value) {
    $suma+= $value;
}
$media = $suma / $numElementos;

echo "Media foreach: $media";
?>