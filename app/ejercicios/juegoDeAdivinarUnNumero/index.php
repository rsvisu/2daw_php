
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Práctica 3 - Juego de Adivinar un Número</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="hero min-h-screen bg-base-200 flex items-center justify-center">
    <div class="max-w-lg bg-white shadow-lg rounded-lg p-8">
        <?php
        // Mensaje de error en caso de que haya.
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<span style='color: red'>$error</span>";
            echo "<br><br>";
        }
        ?>
        <h1 class="text-5xl font-bold text-gray-800 mb-4">Juego de Adivinar un Número</h1>
        <p class="text-lg text-gray-600 mb-6">Selecciona un intervalo del menú:</p>

        <form action="jugar.php" method="POST">
            <fieldset class="space-y-4 text-gray-800">
                <label class="flex items-center space-x-3 border-2 border-gray-300 p-4 rounded-lg hover:bg-gray-100 transition duration-200">
                    <input type="radio" name="intentos" value="10" checked class="radio radio-primary">
                    <span>1-1.023 (2<sup>10</sup>) - 10 intentos</span>
                </label>
                <label class="flex items-center space-x-3 border-2 border-gray-300 p-4 rounded-lg hover:bg-gray-100 transition duration-200">
                    <input type="radio" name="intentos" value="15"  class="radio radio-primary">
                    <span>1-65.535 (2<sup>15</sup>) - 15 intentos</span>
                </label>
                <label class="flex items-center space-x-3 border-2 border-gray-300 p-4 rounded-lg hover:bg-gray-100 transition duration-200">
                    <input type="radio" name="intentos" value="20"  class="radio radio-primary">
                    <span>1-1.048.575 (2<sup>20</sup>) - 20 intentos</span>
                </label>

                <div class="mt-6 text-center">
                    <input type="submit" value="Empezar" name="submit"
                           class="btn btn-primary w-full py-2 text-lg font-semibold">
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>