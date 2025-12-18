<?php
//Escribimos aquí todo el php correspondiente al controlador
//Instrucciones y lógica necesarias queno visualizan valor,lo generan
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de PHP en HTML</title>
    <style>
        .box{
            border: 2px solid #007BFF;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #ffffff;
        }
        .resultado{
            border: 2px solid #007BFF;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #ffffff;
        }
        .box h2{
            margin-top: 0;
            color: #007BFF;
        }

        body{
            font-family: Arial, sans-serif;
            height: 100vh;
            background-color: #f5f5f5;
            width: 80%;
            max-width: 90%;
            margin: auto;
        }
        hr{
            height: 5px;
            background:green
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <h2>Texto enunciado breve</h2>
        <ul>
            <li>Items enunciado</li>
            <li>...</li>
        </ul>
    </div>

    <!-- Sección para el resultado de PHP -->
    <div class="box">
        <h2>Resultado</h2>
        <hr>
        <!--Esposible que aquí también tengamos
        html intercaladocon php-->
        <?php
        //Código php
        ?>
    </div>

</div>
</body>
</html>