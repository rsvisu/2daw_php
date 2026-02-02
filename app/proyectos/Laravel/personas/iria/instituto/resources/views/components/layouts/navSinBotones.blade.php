<nav class="height-nav bg-header justify-between flex flex-row p-8 ">
    <img src="{{ asset("img/paper.svg") }}" alt="logotipo"/>
    <h1>GESTION DE ALUMNOS</h1>
    @auth
        <p class="text-black">hola {{auth()->user()->name}}</p>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-primary cursor-pointer">Logout</button>
        </form>
    @endauth
    @guest
        <div>
            <a href="{{route("login")}}" class="btn bg-gray-500">Login</a>
            <a href="{{route("register")}}" class="btn bg-gray-500">Register</a>
        </div>
    @endguest
    @guest
        <x-lang/>
    @endguest
</nav>
