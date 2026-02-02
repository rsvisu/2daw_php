<nav {{ $attributes }}>
    <x-nav-link type="button" href="{{ route('home') }}" :active="request()->is('/')">Home</x-nav-link>
    <x-nav-link href="{{ route('about') }}" :active="request()->is('about')">About</x-nav-link>
    <x-nav-link href="{{ route('contact') }}" :active="request()->is('contact')">Contact</x-nav-link>
    <x-nav-link href="{{ route('ideas') }}" :active="request()->is('ideas')">Ideas</x-nav-link>
</nav>
