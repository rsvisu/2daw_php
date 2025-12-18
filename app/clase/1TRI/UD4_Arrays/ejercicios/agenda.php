<!-- https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Arrays/practica -->
<?php

// RF2 Control de errores
// RF2.1 No permitir un nombre vacío
// RF2.2 No permitir un teléfono no numércio
// RF2.3 No se permite dos contactos con el mismo teléfono
// RF2.4 No permitir teléfono vacío de un contacto que no existe

// RF 1 Si no hay error
// RF1.1  Si nombre y teléfono
// RF1.1.1  Si nombre no existe en contactos añado
// RF1.1.2  Si nombre  existe en contactos modifico
// RF1.2 Si nombre y no telefono elimino
// RF1.3 Si aprieto borrar contactos eliminar todos


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

<?php
// -- Funciones --

// - Recogida del POST:
function recogerNombre(): string
{
    $nombre = filter_input(INPUT_POST, "nombre") ?? "";
    $nombre = htmlspecialchars($nombre);
    $nombre = trim($nombre);

    return $nombre;
}

function recogerTelefono(): string
{
    $telefono = filter_input(INPUT_POST, "telefono") ?? "";
    $telefono = htmlspecialchars($telefono);
    $telefono = trim($telefono);

    return $telefono;
}

function recuperarAgenda(): array
{
    $agenda = $_POST["agenda"] ?? [];
    return $agenda;
}

// - Validacion:
// Valida los datos y devuelve el error o vacio si esta tod0 correcto.
function validarDatos($nombre, $telefono, $agenda): string
{
    // Valida si el nombre existe.
    if (empty($nombre)) {
        return "Nombre no ingresado.";
    }

    // Valida si el telefono es numerico.
    if (!empty($telefono) && !is_numeric($telefono)) {
        return "Telefono no numerico.";
    }

    // Valida si existe el telefono.
    $existeTelefono = in_array($telefono, $agenda);
    if ($existeTelefono) {
        return "El telefono ingresado ya existe.";
    }

    // Valida si el contacto no existe y el telefono esta vacio.
    $existeContacto = isset($agenda[$nombre]);
    if (!$existeContacto && empty($telefono)) {
        return "Debes ingresar un numero de telefono para el contacto.";
    }

    // Devuelve vacio si tod0 esta correcto.
    return "";
}

// Funciones para el HTML.
function enviarAgendaHtml(array $agenda): string
{
    $html = "";

    // Por cada contacto creamos un input hidden que luego vamos a añadir al HTML.
    foreach ($agenda as $nombre => $telefono) {
        $input = "<input type=hidden name='agenda[$nombre]' value=$telefono />";
        $html .= $input . "\n";
    }

    return $html;
}

function mostrarAgendaHtml(array $agenda): string
{
    $html = "";

    // Por cada contacto creamos una fila que luego vamos a añadir al HTML.
    foreach ($agenda as $nombre => $telefono) {
        $fila = <<<HTML
        <tr>
            <td>$nombre</td>
            <td>$telefono</td>
        </tr>
        HTML;

        $html .= $fila . "\n";
    }

    if (empty($html)) {
        return "<p>Agenda sin contactos.</p>";
    } else {
        return <<<HTML
        <table>
            $html
        </table>
        HTML;
    }
}

?>

<?php
// -- Programa principal --
// Declaracion de la agenda.
$agenda = [];

// Guardamos la accion del usuario.
$accion = filter_input(INPUT_POST, "enviar");

// Si se ha elegido "Añadir contacto" cargamos la agenda y procesamos al nuevo contacto.
// En otro caso, que seria el de "Eliminar contactos" o no acabar de cargar la pagina dejamos la agenda vacia.
if ($accion === "Añadir contacto") {
    $agenda = recuperarAgenda();

    // Declaracion de las variables.
    $errores = [];
    $nombre = "";
    $telefono = "";

    // Recogemos el nombre y telefono.
    $nombre = recogerNombre();
    $telefono = recogerTelefono();

    // Validamos los datos y guardamos el error.
    $error = validarDatos($nombre, $telefono, $agenda);

    // Si no hay error operamos.
    if (empty($error)) {
        // Si el numero esta vacio borramos el contacto. Al validar
        // los datos ya nos hemos asegurado de que el contacto exista.
        if (empty($telefono)) {
            unset($agenda[$nombre]);
        } // Si no, lo agregamos.
        else {
            $agenda[$nombre] = $telefono;
        }
    }
}

// Sacamos el numero de contactos de la agenda.
$numContactos = count($agenda);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./agenda.css" type="text/css">
    <title>Agenda de contactos</title>
</head>
<body>
<main>
    <header>
        Agenda de contactos: con <?= $numContactos ?> contactos
    </header>
    <div class="listado_contactos">
        <div class="center"><h2>Listado de contactos:</h2></div>
        <hr>
        <div class="center">
            <?= mostrarAgendaHtml($agenda) ?>
        </div>
    </div>
    <!-- Creamos el formulario para insertr los nuevos datos-->
    <fieldset>
        <div class="center"><h2>Nuevo contacto:</h2></div>
        <hr>
        <form action="#" method="post">
            <br>

            <!-- Nombre y telefono -->
            <label for="nombre">Nombre: </label><input type="text" name="nombre" size="15"/><br/>
            <label for="telefono">Teléfono: </label><input type="text" name="telefono" size="15"/><br/>
            <input type="submit" value="Añadir contacto" name="enviar">
            <input type="submit" value="Eliminar contactos" name="enviar" <?= ($numContactos == 0) ? "disabled" : "" ?>>

            <!-- Metemos los contactos existentes ocultos en el formulario-->
            <?= enviarAgendaHtml($agenda) ?>
        </form>
        <!-- Mostramos el error si hay alguno -->
        <?php if (!empty($error)): ?>
            <div class="error">
                <hr>
                <?= $error ?>
            </div>
        <?php endif; ?>
    </fieldset>
</main>
</body>

</html>