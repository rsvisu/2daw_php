<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        main {
            width: fit-content;
            margin: auto;
        }

        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <main>
        <h1>Tabla con numeros en diferentes notaciones:</h1>
        <table>
            <tr>
                <th>Decimal</th>
                <th>Hexadecimal</th>
                <th>Octal</th>
                <th>Binario</th>
            </tr>

            <?php

            for ($i = 1; $i <= 256; $i++) {
                $bin = decbin($i);
                $oct = decoct($i);
                $hex = dechex($i);
                
                echo "<tr>";
                echo "<td>$i</td><td>$hex</td><td>$oct</td><td>$bin</td>";
                echo "</tr>";

            }

            ?>
        </table>
    </main>
</body>
</html>