<?php
// COMPROBACION
$envioPorUsuario = isset($_POST['formularioRed']);
$red = "";
if ($envioPorUsuario) {
    // LECTURA
    // Mascara
    $mask1 = (int)filter_input(INPUT_POST, "mask1", FILTER_SANITIZE_NUMBER_INT);
    $mask2 = (int)filter_input(INPUT_POST, "mask2", FILTER_SANITIZE_NUMBER_INT);
    $mask3 = (int)filter_input(INPUT_POST, "mask3", FILTER_SANITIZE_NUMBER_INT);
    $mask4 = (int)filter_input(INPUT_POST, "mask4", FILTER_SANITIZE_NUMBER_INT);
    // IP
    $ip1 = (int)filter_input(INPUT_POST, "ip1", FILTER_SANITIZE_NUMBER_INT);
    $ip2 = (int)filter_input(INPUT_POST, "ip2", FILTER_SANITIZE_NUMBER_INT);
    $ip3 = (int)filter_input(INPUT_POST, "ip3", FILTER_SANITIZE_NUMBER_INT);
    $ip4 = (int)filter_input(INPUT_POST, "ip4", FILTER_SANITIZE_NUMBER_INT);

    // GENERACION
    $red1 = $mask1 & $ip1;
    $red2 = $mask2 & $ip2;
    $red3 = $mask3 & $ip3;
    $red4 = $mask4 & $ip4;

    // FORMATEO
    $red = "$red1.$red2.$red3.$red4";
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h2>Direccion de red a partir de la ip y mascara:</h2>
<form action="#formularioRed" method="POST">
    <fieldset style="background: antiquewhite;" id="formularioRed">
        <fieldset style="background: beige;">
            <legend>Mascara de red:</legend>
            <input type="number" name="mask1" value="<?= $mask1 ?? 255 ?>">
            <input type="number" name="mask2" value="<?= $mask2 ?? 255 ?>">
            <input type="number" name="mask3" value="<?= $mask3 ?? 255 ?>">
            <input type="number" name="mask4" value="<?= $mask4 ?? 255 ?>">
        </fieldset>
        <fieldset style="background: beige;">
            <legend>IP:</legend>
            <input type="number" name="ip1" value="<?= $ip1 ?? 0 ?>">
            <input type="number" name="ip2" value="<?= $ip2 ?? 0 ?>">
            <input type="number" name="ip3" value="<?= $ip3 ?? 0 ?>">
            <input type="number" name="ip4" value="<?= $ip4 ?? 0 ?>">
        </fieldset>
        <input type="submit" name="formularioRed" value="Enviar">
    </fieldset>
</form>

<?php if ($envioPorUsuario): ?>
    <fieldset style="background: antiquewhite;">
        <legend>Red:</legend>
        <h3><?= $red ?></h3>
    </fieldset>
<?php endif; ?>
</body>
</html>