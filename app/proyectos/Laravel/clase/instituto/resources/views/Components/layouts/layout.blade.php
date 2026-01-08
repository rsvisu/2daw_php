<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite("resources/css/app.css")
</head>
<body>
<x-layouts.header/>
<x-layouts.nav/>
<main>
    {{$slot}}
</main>
</body>
</html>
