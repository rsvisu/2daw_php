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
        <h1>Tabla con numeros y su represntacion ascii:</h1>
        <table>
            <tr>
                <th>Numero</th>
                <th>Ascii</th>
            </tr>

            <?php

            for ($i = 33; $i <= 126; $i++) {
                $ascii = chr($i);
                echo "<tr>\n";
                    echo "\t<td>$i</td>\n";
                    echo "\t<td>$ascii</td>\n";
                echo "</tr>\n";
            }

            ?>
        </table>
    </main>
</body>
</html>