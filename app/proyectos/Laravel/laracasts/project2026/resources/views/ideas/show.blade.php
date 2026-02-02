<x-layout title="Ideas">
    <x-slot:heading>
        Idea #{{ $idea->id }}
    </x-slot:heading>
    <h2 class="text-xl mb-5">Your idea</h2>

    <div class="bg-neutral-600 px-2 py-4 font-mono">
        <p>{{ $idea->description }}</p>
    </div>

    <div class="mt-6">
        <a href="/ideas/{{ $idea->id }}/edit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            Edit
        </a>
    </div>
</x-layout>
