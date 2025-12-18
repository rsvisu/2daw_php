<?php

use Controladores\Alumno;

require  "../vendor/autoload.php";

$faker = Faker\Factory::create("ES_es");

for ($i = 0; $i < 5; $i++) {
    $nombre = $faker->name();
    $email = $faker->email();
    $alumnos[] = new Alumno($nombre, $email);
}

echo "<h1>Alumnos:</h1>";

usort($alumnos, function($a, $b) {
    return $a->name <=> $b->name;
});

foreach ($alumnos as $alumno) {
    echo $alumno . "<br>";
}

?>