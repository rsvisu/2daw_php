@props(['title' => 'Example'])
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <title>{{ $title }}</title>
</head>
<body class="bg-neutral-900 text-neutral-100 font-sans min-h-screen">
<x-nav class="h-15 bg-black flex items-center px-4 space-x-2 border-b-2 border-neutral-800"></x-nav>
<header class="h-16 bg-neutral-800 flex items-center px-6 border-b border-neutral-700">
    <div>
        <h1 class="text-xl font-semibold"> {{ $heading }}</h1>
    </div>
</header>
<main class="p-6">
    <div>
        {{ $slot }}
    </div>
</main>
</body>
</html>
