<x-layout title="Job - {{ $job['title'] }}">
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job["title"] }}:</h2>
    <p>Pays {{ $job["salary"] }}$ per year.</p>
</x-layout>
