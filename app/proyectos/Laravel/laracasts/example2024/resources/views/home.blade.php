<x-layout title="Home">
    <x-slot:heading>
        Home
    </x-slot:heading>
    <h1>Welcome{{ $name ? " $name" : "" }}!</h1>
</x-layout>
