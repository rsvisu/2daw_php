<?php
// Stock de la tienda.
$productos = [
        'lechuga' => ['unidades' => 200, 'precio' => 0.90],
        'tomate' => ['unidades' => 2000, 'precio' => 2.15],
        'cebolla' => ['unidades' => 3200, 'precio' => 0.49],
        'fresa' => ['unidades' => 4800, 'precio' => 4.50],
        'manzana' => ['unidades' => 2500, 'precio' => 2.10],
];

// Variables de la compra.
$compra = [];
$compra_exitosa = [];
$compra_fallida = [];

// Recogida de los productos comprados.
if (($_POST["submit"] ?? "") === "Comprar") {
    // Recogemos la compra.
    $compra = $_POST["compra"] ?? [];

    // Actualizamos el stock.
    foreach ($compra as $producto => $cantidad) {
        // Si la cantidad no es valida o igual a 0 saltamos el producto.
        if ($cantidad <= 0) {
            continue;
        }

        // Actualizamos el stock de los productos y guardamos las compras
        // existosas y las fallidas para luego mostrarlas en la factura.
        $stock = &$productos[$producto]['unidades'];
        $precio = $productos[$producto]['precio'];
        if ($stock >= $cantidad) {
            $stock -= $cantidad;
            $compra_exitosa[$producto] = [
                    "cantidad" => $cantidad,
                    "precio" => $precio
            ];
        } else {
            $compra_fallida[$producto] = [
                    "cantidad" => $cantidad,
                    "stock" => $stock
            ];
        }
    }
}
?>

<?php
function mostrarFormulario($productos): string
{

    $body = "";
    foreach ($productos as $producto => $datos) {

        // Datos del producto.
        $nombre = ucfirst(strtolower($producto));
        $stock = $datos["unidades"];
        $precio = $datos["precio"];

        // Creamos el cuerpo del formulario.
        $body .= <<<HTML
            <label><b>$nombre</b> (Stock: $stock, Precio: $precio €):<br>
            <input type="number" name="compra[$producto]" value="0"></label><br><br>
            HTML. "\n";
    }

    // Creamos el html completo del formulario.
    $html = <<<HTML
    <fieldset>
    <h3>Comprar productos:</h3>
    <form action="#" method="POST">
        $body
        <input type="submit" name="submit" value="Comprar">
    </form>
    </fieldset>
    HTML;

    return $html;
}

function mostrarFactura($compras_exitosa, $compras_fallida): string
{
    $total = 0;
    $body = "";
    // Recorremos la compra y vamos añadiendo al cuerpo del
    // HTML final el nombre del producto y su cantidad.

    // Compras exitosas
    foreach ($compras_exitosa as $producto => $datos) {

        // Datos del producto.
        $nombre = strtolower($producto);
        $cantidad = $datos["cantidad"];
        $precio = $datos["precio"];
        $totalUnitario = $cantidad * $precio;

        // Sumatorio del total.
        $total += $totalUnitario;

        // Cuerpo.
        $body .=
        <<<HTML
        <li>$cantidad {$nombre}/s a {$precio}€: {$totalUnitario}€</li>
        HTML . "\n";

    }

    // Compras fallidas.
    foreach ($compras_fallida as $producto => $datos) {
        // Datos del producto.
        $nombre = strtolower($producto);

        // Cuerpo del formulario.
        $body .=
        <<<HTML
        <li> No ha sido posible facturar "<b>$nombre</b>". La cantidad {$datos["cantidad"]} rebasa el stock disponible de {$datos["stock"]}.</li>
        HTML . "\n";

    }

    // Si no hay productos añadimos un mensaje.
    if (!$body) {
        $body = "<p>No hay productos para facturar.</p>";
    } else {
        $body =
        <<<HTML
        <ul>\n$body</ul>
        <p><b>Total</b>: {$total}€</p>
        HTML;
    }

    // Creamos el html completo del formulario.
    $html =
    <<<HTML
    <fieldset>
    <h3>Factura productos:</h3>
        $body
    </fieldset>
    HTML;

    return $html;

}

function mostrarInventario($productos): string
{

    $body = "";
    foreach ($productos as $producto => $datos) {

        // Datos del producto.
        $nombre = ucfirst(strtolower($producto));
        $stock = $datos["unidades"];

        // Creamos el cuerpo del formulario.
        $body .= <<<HTML
            <p><b>$nombre:</b> $stock cantidad/es.</p>
            HTML. "\n";
    }

    // Creamos el html completo del formulario.
    $html = <<<HTML
    <fieldset>
    <h3>Inventario productos:</h3>
        $body
    </fieldset>
    HTML;

    return $html;

}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supermercado</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        fieldset {
            background: antiquewhite;
            width: fit-content;
            margin: 10px;
        }

        fieldset a {
            color: black;
            text-decoration: none;
        }

        fieldset a:hover {
            color: dimgray;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>Supermercado:</h1>
<hr style="width: 400px">
<?php
if (isset($_POST['submit'])) {
    echo mostrarFactura($compra_exitosa, $compra_fallida);
    echo mostrarInventario($productos);

    // Boton de volver a comprar.
    echo <<<HTML
    <fieldset>
        <a href={$_SERVER["PHP_SELF"]}>Volver a comprar.</a>
    </fieldset>
    HTML;
} else {
    echo mostrarFormulario($productos);
}
?>
</body>
</html>
