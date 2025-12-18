<?php

function validar_error (array $agenda, string $nombre, string $telefono):null|string{
    $error=null;
    $error .= $nombre==""? "El nombre no puede estar vacío <br />": $error;
    $error .= !is_numeric($telefono)? "El teléfono $telefono no es numérico <br />": $error;
    $error .= (!isset($agenda[$nombre])&&($telefono ==""))? "No se puede eliminar un contacto que no existe":$error;
    $error .= in_array($telefono, $agenda)? "El teléfono ya existe ":$error;
    return $error;
}

function realiza_accion(&$agenda, $nombre, $telefono):string{
    if ($telefono==""){
        unset($agenda[$nombre]);
        $msj="Se ha eliminado el contacto $nombre";
    } else{
        $accion = isset($agenda[$nombre])? "modificar" : "agregar";
        $agenda[$nombre]=$telefono;
        $msj = "Se ah $accion el contacto $nombre";
    }
    return $msj;
}


$agenda = $_POST["agenda"] ?? [];

if (isset($_POST['submit'])) {
    //Leer los datos
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);


    $error = validar_error($agenda, $nombre, $telefono);
    $opcion = $_POST['submit'] ?? null;
    if ($error == null)
        switch ($opcion) {
            case "Añadir contacto":
                $msj = realiza_accion($agenda, $nombre, $telefono);
                break;
            case "Eliminar contactos":
                $agenda=[];
                $msj= "La agenda ha sido eliminada";
                break;
            default:
        }
}

//Generar los informes o datos para el html

$tabla_agenda = dame_contenido_agenda($agenda);
$disabled = sizeof($agenda) ==0? "disabled":"";
$contactos = sizeof($agenda);  //Ojo la agenda tiene que existir
$plural = sizeof($agenda)>1?"s":"";
$inputs_hidden = dame_agenda_input_hidden($agenda);




// RF2 Control de errores
// RF2.1 No permitir un nombre vacío
// RF2.2 No permitir un teléfono no numércio
// RF2.3 No se permite dos contactos con el mismo teléfono
// RF2.4 No permitir teléfono vacío de un contacto que no existe
//RF 1 Si no hay error
// RF1.1  Si nombre y teléfono
// RF1.1.1  Si nombre no existe en contactos añado
// RF1.1.2  Si nombre  existe en contactos modifico
// RF1.2 Si nombre y no telefono elimino
// RF1.3 Si aprieto borrar contactos eliminar todos
// RF1.4 Mantengo entre diferentes solicitudes los datos de la agenda


// RF 3 Salidas que genera el programa
// RF 3.1 Un listado de los contactos o no hay contactos
// RF 3.2 Mostrar el error
// RF 3.3 Deshabilitar el botón borrar contactos si no hay
// RF 3.4 Informo el número de contactos
// RF 3.5 Mostrar los contactos ordenados por nombre


//
// RF3
// RF4


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title> Agenda de contactos</title>
    <style>
        .center{
            text-align: center;
            color:darkblue;
            font-weight: bold;
            font-size:1,6em;
            margin:30px;
        }
        table{
            margin: 30px;

        }
        table, th, tr, td{
            border-collapse: collapse;
            border: 2px solid blue;
            padding: 3px;

        }
        header {
            #background: #9d3e42;
            background: #5D6D7E;
            height: 60px;
            text-align: center;
            font-weight: bold;
            font-size: 2.5em;
            color:darkorange;
            float:none;
        }
        fieldset{
            background : #AEB6BF;
            float:left;
            margin: 10px;
            width:35%;
        }
        legend{
            color:darkblue;
            font-weight: bold;
            font-size:1,6em;
            font-style:oblique;
        }

        input[type=text]{
            color:blue;
            font-weight: bold;
            font-size:1,6em;
        }
        input[type=submit]{
            color:maroon;
            font-weight: bold;
            font-size:1,8em;
            margin-top:20px;
        }
        input[type="submit"][disabled]{
            color:darkgrey;
            font-weight: normal;
        }

        label{
            color:blue;
            font-weight: bold;
            font-size:1,4em;

        }
        .listado_contactos{
            background : #AEB6BF;
            float:right;
            margin: 10px;
            width:55%;
        }
        .variable{
            color:maroon;
            font-weight: bold;
            font-size: 1.3em;
        }
    </style>
</head>
<header>
    Agenda de contactos: con <?=$contactos?> contacto<?=$plural?>
</header>
<body>

<div class="listado_contactos">
    <div class="center">LISTADO DE CONTACTOS</div>
    <hr>
    <div class="center">
        <?=$tabla_agenda?>
    </div>
</div>
<!-- Creamos el formulario para insertr los nuevos datos-->
<fieldset>
    <legend>Nuevo Contacto</legend>
    <form action=/dwes/practicas/agenda/index.php method="post">
        <br>
        <label for="nombre">Nombre</label><input type="text" name="nombre" size="15"/><br/>
        <label for="telefono">Teléfono </label><input type="text" name="telefono" size="15"/><br/>
        <input type="submit" value="Añadir contacto" name="enviar">
        <input type="submit" value="Eliminar contactos" name="enviar">

        <!-- Metemos los contactos existentes  ocultos en el formulario-->
        <?=$inputs_hidden?>
    </form>
</fieldset>
<div style="clear:both ">
    <hr/>
    <?=$error ??""?>
</div>

</body>

</html>