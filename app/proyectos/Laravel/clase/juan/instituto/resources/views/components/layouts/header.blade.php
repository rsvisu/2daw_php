<header class="h-header bg-header flex justify-between px-5">
  <img src="{{ asset("img/logo.png") }}" alt="logo" class="">
  <h1 class="text-4xl text-blue-900">GESTION DEL INSTITUTO</h1>
  @auth
    <p>hola {{auth()->user()->name}}</p>
  @endauth
  @guest
    <div>
      <a href="">Login</a>
      <a href="">Register</a>
    </div>
  @endguest
</header>