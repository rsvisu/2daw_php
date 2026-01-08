<header class="h-15 bg-header flex justify-between">
    <img src="{{asset("images/img.png")}}">
    <h1 class="text-4xl text-blue-900">Gestion del instituto</h1>
    @auth

    @endauth
    @guest
        <div>
            <button class="btn btn-sm btn-primary">Login</button>
            <button class="btn btn-sm btn-primary">Registro</button>
        </div>
    @endguest
</header>
