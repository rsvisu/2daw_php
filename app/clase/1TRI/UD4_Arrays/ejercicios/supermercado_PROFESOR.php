<?php
function get_factura_inventario($productos): array
{
    $factura = "<h1 class='text-3xl text-green-700 text-center mb-3'>Factura</h1>";
    $inventario = "<h1 class='text-3xl text-green-700 text-center mb-3'>Inventario</h1>";

    $total = 0;
    foreach ($productos as $producto => $detalle) {
        // XX unidades de PRODUCTO a xx euros = XXX
        $unidades = filter_input(INPUT_POST, $producto, FILTER_VALIDATE_INT);

        if ($unidades != 0) {
            $unidades = $unidades > $detalle['unidades'] ? $detalle['unidades'] : $unidades;
            $precio = $detalle['precio'];
            $subtotal = $precio * $unidades;
            $factura .= "<div>";
            $factura .= "$unidades unidades de $producto a $precio = <strong>$subtotal</strong>";
            $factura .= "</div>";
            $total += $subtotal;
        }
        $inventario .= "<div>";
        $resto = $detalle['unidades'] - $unidades;
        $inventario .= "<strong>$producto</strong> quedan $resto unidades";
        $inventario .= "</div>";
    }
    $factura .= "<div><hr class='bg-blue-500 border-2'/><h1 class='font-bold'>TOTAL FActura $total Euros<hr class='bg-blue-500 border-2'/></div>";
    return [$factura, $inventario];


}

function get_formulario(array $productos): string
{
    $inputs_html = "";
    foreach ($productos as $producto => $unidades) $inputs_html .= <<<FIN
            <div class=" mb-4 form-group flex justify-around w-full">
                <label for= $producto>$producto</label>
                <input  class="rounded-sm border border-blue-500" type="text" name="$producto" id="">
            </div>    

        FIN;

    return $inputs_html;
}

$productos = ['lechuga' => ['unidades' => 200,
        'precio' => 0.90],
        'tomates' => ['unidades' => 2000,
                'precio' => 2.15],
        'cebollas' => ['unidades' => 3200,
                'precio' => 0.49],
        'fresas' => ['unidades' => 4800,
                'precio' => 4.50],
        'manzanas' => ['unidades' => 2500,
                'precio' => 2.10]];
if (isset($_POST['submit'])) {

    list($factura, $inventario) = get_factura_inventario($productos);
} else
    $formulario = get_formulario($productos);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="flex flex-col h-screen justify-center items-center bg-gray-200">
    <?php if (isset($formulario)): ?>
        <form class="bg-white rounded-lg shadow-md p-6 w-full max-w-sm "
              action="#" method="post">
            <?= $formulario ?>
            <input type="submit" value="Comprar" name="submit"
                   class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </form>
    <?php else : ?>
        <div class="flex flex-col">
            <div class='flex flex-row md:flex-row justify-center items-center gap-6'>
                <div class='bg-white text-2xl p-6 shadow-md '>
                    <?= $factura ?>
                </div>
                <hr/>
                <div class='bg-white text-2xl p-6 shadow-md '>
                    <?= $inventario ?>
                </div>
            </div>
            <a class=" bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600
            focus:outline-none focus:ring-2 focus:ring-blue-500 mt-12 "
               href=<?= $_SERVER["PHP_SELF"] ?>>Volver a comprar</a>
        </div>
    <?php endif; ?>

</body>
</html>