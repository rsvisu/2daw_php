<?php

    echo "<h1>Variables:</h1>";
    $num1 = 128;
    $num_bin = 0b101;
    $num_oct = 0o7747;
    $num_hex = 0xA534BD;
    $num_largo = 1_543_876_432_543;
    $num_cientifico = 1E-9;
    echo "<h3>$num1</h3>";
    echo "<h3>$num_bin</h3>";
    echo "<h3>$num_oct</h3>";
    echo "<h3>$num_hex</h3>";
    echo "<h3>$num_largo</h3>";
    echo "<h3>$num_cientifico</h3>";

    echo "<h1>Constantes:</h1>";
    const IVA = 0.21;
    define("IVA_BASE", 0.10);

    echo "<h3>Direccion del archivo: </h3>";
    echo __DIR__;

    echo "<h3>Linea donde esta ese codigo: </h3>";
    echo __LINE__;

?>
