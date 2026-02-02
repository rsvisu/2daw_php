<x-layout title="Jobs">
    <x-slot:heading>
        Jobs
    </x-slot:heading>
    <h1>List of jobs:</h1>
    <ul>
        @foreach($jobs as $job)
            <li>
                <a href="/jobs/{{ $job["id"] }}" class="hover:text-gray-300 hover:underline">
                    <strong>- {{ $job["title"] }}:</strong> {{ $job["salary"] }}$ per year.
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
