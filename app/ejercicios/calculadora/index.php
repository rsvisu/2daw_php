<?php

require_once "Operacion.php";
require_once "OperacionRacional.php";
require_once "OperacionReal.php";

$error = false;
if (isset($_POST["cadena"])) {
    $cadena = filter_input(INPUT_POST, "cadena");
    $tipoOperacion = Operacion::tipoOperacion($cadena);
    switch ($tipoOperacion) {
        case Operacion::REAL:
            $operacion = new OperacionReal($cadena);
            $resultado = $operacion->operar();
            break;
        case Operacion::RACIONAL:
            $operacion = new OperacionRacional($cadena);
            $resultado = $operacion->operar();
            break;
        case Operacion::ERROR:
            $error = true;
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" media="screen"/>
</head>
<body>
<header>
    <h1>Calculadora Real / Racional</h1>
</header>
<aside>
    <fieldset id="ayuda">
        <legend>Reglas de uso de la calculadora</legend>
        <ul>
            <li>La calculadora se usa escribiendo la operación.</li>
            <li>La operación será <strong>Operando_1 operación Operando_2</strong>.</li>
            <li>Cada operando puede ser número <i>positivo</i><strong> real o racional.</strong></li>
            <li>Real p.e. <strong>5</strong> o <strong>5.12 </strong> Racional p.e <strong> 6/3 </strong>o<strong>
                    7/1</strong></li>
            <li>Los operadores reales permitidos son <strong><span class="destacado"> +  -  *  /</span></strong></li>
            <li>Los operadores racionales permitidos son <strong><span class="destacado"> +  -  *  :</span> </strong>
            </li>
            <li>No se deben de dejar espacios en blanco entre operandos y operación</li>
            <li>Si un operando es real y el otro racional se considerará operación racional</label></li>
            <li>Ejemplos:
                <ul>
                    <li>(Real) <strong>5.1+4</strong></li>
                    <li>(Racional) <strong>5/1:2</strong></li>
                    <li>(Error) <strong>5.2+5/1</strong></li>
                    <li>(Error) <strong>52214+</strong></li>
                </ul>
            </li>
        </ul>
    </fieldset>
</aside>
<main>
    <fieldset>
        <legend>Establece la operación</legend>
        <form action="#" method="post">
            <label for="cadena">Operación</label>
            <input type="text" name="cadena" id="cadena">
            <input type="submit" name="enviar" value="Calcular">
        </form>
        <!-- Mostramos el resultado si existe -->
        <?php if(isset($resultado)): ?>
            <label class='destacado'><?="$cadena = $resultado"?></label>
        <?php endif; ?>
    </fieldset>
    <fieldset id=rtdo>
        <legend>Resultado</legend>
        <!-- Si hay un error lo mostramos -->
        <?php if($error): ?>
            <label>La operación <span class='destacado'><?=$cadena?></span> no es una operación válida</label>
        <!-- Si no, si hay resultado mostramos la tabla -->
        <?php elseif (isset($resultado)): ?>
            <table border=1>
                <tr>
                    <th>Concepto</th>
                    <th>Valores</th>
                </tr>
                <tr>
                    <td>Operando 1</td>
                    <td><?=$operacion->getOp1()?></td>
                </tr>
                <tr>
                    <td>Operando 2</td>
                    <td><?=$operacion->getOp2()?></td>
                </tr>
                <tr>
                    <td>Operación</td>
                    <td><?=$operacion->getOperacion()?></td>
                </tr>
                <!-- Mostramos filas diferentes segun si es una operacion real o racional -->
                <?php if($tipoOperacion === $operacion::REAL): ?>
                    <tr>
                        <td>Tipo de operación</td>
                        <td>Real</td>
                    </tr>
                    <tr>
                        <td>Resultado</td>
                        <td><?=$resultado?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>Tipo de operación</td>
                        <td>Racional</td>
                    </tr>
                    <tr>
                        <td>Resultado</td>
                        <td><?=$resultado?></td>
                    </tr>
                    <tr>
                        <td>Resultado simplificado</td>
                        <td><?=$resultado->simplificar()?></td>
                    </tr>
                <?php endif; ?>
            </table>
        <?php endif; ?>
    </fieldset>
</main>

</body>
</html>
