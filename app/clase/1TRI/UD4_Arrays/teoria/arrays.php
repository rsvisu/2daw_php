<?php

// Creando e inicializando un array
$lista = [1, 7, "Hola", 5=>"Posicion 5", "PHP"];
var_dump($lista);

// Añadir
$lista[100] = "Pos100";
$lista[] = "Siguiente posicion libre";
var_dump($lista);

// Ordenar
sort($lista);
var_dump($lista);

// Array aleatorio de notas
$notas = array_fill(0, 20, 0);
$inicializa = fn()=>rand(1,10);
$notas = array_map($inicializa, $notas);

// Operaciones
$max = max($notas);
$min = min($notas);
$suma = array_sum($notas);
$numNotas = count($notas);


?>