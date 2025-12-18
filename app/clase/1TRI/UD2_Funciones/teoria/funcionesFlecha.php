<?php

$nombre = "Manuel";

$mayor = fn($a, $b)=> match ($a<=>$b) {
    1 => "$nombre dice que $a es mayor que $b.",
    -1 => "$nombre dice que $b es mayor que $a.",
    0 => "$nombre dice que $a es igual que $b."
};

// Con la funcion flecha se puede acceder automaticamente a las variables del contexto.

$a = rand(1,10);
$b = rand(1,10);
$mensaje = $mayor($a,$b);

echo $mensaje;

?>