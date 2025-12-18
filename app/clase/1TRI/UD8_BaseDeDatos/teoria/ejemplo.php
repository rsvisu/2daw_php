<?php


try {
    $con = new mysqli("mysql", "alumno", "alumno", "alumnos");
    var_dump($con);
} catch (mysqli_sql_exception $e) {
    die("Error: " . $e->getMessage() . "</br>");
}

?>