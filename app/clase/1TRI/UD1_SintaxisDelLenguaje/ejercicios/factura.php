<?php
// Declaracion variables
$cliente = "Juan Pérez";
$fecha = date("d/m/Y");
$factura = 1;
$producto1 = "Cuadros";
$precio1 = rand(1, 100);
$producto2 = "Luminarias intensas";
$precio2 = rand(1, 100);

// Resto del programa
$ancho = 40;

$separador = str_repeat("-", $ancho);
$titulo = str_pad("FACTURA Nº$factura", $ancho, " ", STR_PAD_BOTH);;
$linea1 = factura . phpphpstr_pad("Fecha:", $ancho - strlen($fecha), " ", STR_PAD_RIGHT) . $fecha;
$linea2 = factura . phpphpstr_pad("Producto:", $ancho - strlen($producto1), " ", STR_PAD_RIGHT) . $producto1;;
$linea3 = factura . phpphpstr_pad("Precio:", $ancho - strlen($precio1), " ", STR_PAD_RIGHT) . $precio1;;
$linea4 = factura . phpphpstr_pad("Producto:", $ancho - strlen($producto2), " ", STR_PAD_RIGHT) . $producto2;;
$linea5 = factura . phpphpstr_pad("Precio:", $ancho - strlen($precio2), " ", STR_PAD_RIGHT) . $precio2;;

$factura =<<<FIN
$separador
$titulo
$separador
$linea1

$linea2
$linea3

$linea4
$linea5

FIN;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <pre><?="$factura"?></pre>
</body>
</html>
