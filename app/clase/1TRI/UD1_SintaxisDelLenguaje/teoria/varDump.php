<?php
    echo "<h3>Valor de tipo boolean:</h3>";
    $varBoolean = true;
    var_dump($varBoolean);
    echo "<br>";

    echo "<h3>Valor de tipo integer:</h3>";
    $varInteger = 1;
    var_dump($varInteger);
    echo "<br>";

    echo "<h3>Valor de tipo float:</h3>";
    $varFloat = 1.1;
    var_dump($varFloat);
    echo "<br>";

    echo "<h3>Valor de tipo string:</h3>";
    $varString = "string";
    var_dump($varString);
    echo "<br>";

    echo "<h3>Valor de tipo null:</h3>";
    $varNull = null;
    var_dump($varNull);
    echo "<br>";

    echo "<h3>Valor de tipo array:</h3>";
    $varArray = [1, 2, 3];
    var_dump($varArray);
    echo "<br>";

    echo "<hr>";

    $a = [1,2,3];
    echo "La variable \$a vale: ".var_dump($a)." - FIN";
    echo "<br>";
    echo "La variable \$a vale: ".print_r($a)." - FIN";
?>
