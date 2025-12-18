<?php
//Si he apretado el submit
$msj=null;
if (isset($_POST['submit'])) {
    //Leo la máscara
    $mask_3 = filter_input(INPUT_POST, 'mask_3', FILTER_VALIDATE_FLOAT);
    $mask_2 = filter_input(INPUT_POST, 'mask_2', FILTER_VALIDATE_FLOAT);
    $mask_1 = filter_input(INPUT_POST, 'mask_1', FILTER_VALIDATE_FLOAT);
    $mask_0 = filter_input(INPUT_POST, 'mask_0', FILTER_VALIDATE_FLOAT);
    //Leo la ip
    $ip_3 = filter_input(INPUT_POST, 'ip_3', FILTER_VALIDATE_FLOAT);
    $ip_2 = filter_input(INPUT_POST, 'ip_2', FILTER_VALIDATE_FLOAT);
    $ip_1 = filter_input(INPUT_POST, 'ip_1', FILTER_VALIDATE_FLOAT);
    $ip_0 = filter_input(INPUT_POST, 'ip_0', FILTER_VALIDATE_FLOAT);

    //Genero la ip de red
    $red_3 = $mask_3 & $ip_3;
    $red_2 = $mask_2 & $ip_2;
    $red_1 = $mask_1 & $ip_1;
    $red_0 = $mask_0 & $ip_0;


    $msj = sprintf("<h3>Ip %0-8b.%0-8b.%0-8b.%0-8b</h3>",$ip_3, $ip_2,$ip_1, $ip_0);
    $msj .= sprintf("<h3>Máscara Ip %0-8b.%0-8b.%0-8b.%0-8b</h3>",$mask_3, $mask_2,$mask_1, $mask_0);
    $msj .= sprintf("<h3>Red Ip %0-8b.%0-8b.%0-8b.%0-8b</h3>",$red_3, $red_2,$red_1, $red_0);




}
//o datos (La ip y la mascara de cada uno)

//nero la ip de red y la muestro



?>

<hl lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <fieldset style="background: antiquewhite;width:70%;margin:10%">
        <legend>Mácaras y redes</legend>
        <form action="index.php" method="POST">
            <h1>Máscara</h1>
            <input size=4 type="text" name="mask_3" value='<?=$mask_3 ?? 255?>' />
            <input size=4 type="text" name="mask_2" value='<?=$mask_2 ?? 255?>' id="">
            <input size=4 type="text" name="mask_1" value='<?=$mask_1 ?? 255?>' id="">
            <input size=4 type="text" name="mask_0" value='<?=$mask_0 ?? 255?>' id="">
            <hr />
            <h1>IP</h1>
            <input size=4 type="text" name="ip_3" value='<?=$ip_3 ?? 255?>' id="">
            <input size=4 type="text" name="ip_2" value='<?=$ip_2 ?? 255?>' id="">
            <input size=4 type="text" name="ip_1" value='<?=$ip_1 ?? 255?>' id="">
            <input size=4 type="text" name="ip_0" value='<?=$ip_0 ?? 255?>' id="">
            <hr />
            <input type="submit" value="Evaluar" name="submit">
        </form>
    </fieldset>
    <?php if (!is_null($msj)):?>
        <h1>Resultado</h1>
        <?=$msj; endif;?>


    </body>
</hl>