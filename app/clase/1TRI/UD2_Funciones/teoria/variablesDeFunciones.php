<?php

$nombre = "Manuel";

$mayor = function (int $a, int $b) use ($nombre) : string {
    return match ($a<=>$b) {
        1 => "$nombre dice que $a es mayor que $b.",
        -1 => "$nombre dice que $b es mayor que $a.",
        0 => "$nombre dice que $a es igual que $b."
    };
};

// Para usar variables del contexto en funciones se usa la palabra use.

$a = rand(1,10);
$b = rand(1,10);
$mensaje = $mayor($a,$b);

echo $mensaje;

?>