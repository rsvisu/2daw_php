<x-layout title="Ideas">
    <x-slot:heading>
        Ideas
    </x-slot:heading>
    <h2 class="text-xl mb-5">Your ideas</h2>
    <div>
        @if(count($ideas))

            <ul>
                @foreach($ideas as $idea)
                    <li class="mt-4">{{ $idea->description }}
                        <a href="/ideas/{{ $idea->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20px" height="20px"
                                 viewBox="0 0 64 64" stroke-width="3" stroke="#FFFFFF" fill="none">
                                <path
                                    d="M55.4,32V53.58a1.81,1.81,0,0,1-1.82,1.82H10.42A1.81,1.81,0,0,1,8.6,53.58V10.42A1.81,1.81,0,0,1,10.42,8.6H32"/>
                                <polyline points="40.32 8.6 55.4 8.6 55.4 24.18"/>
                                <line x1="19.32" y1="45.72" x2="54.61" y2="8.91"/>
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="">You dont have any ideas</p>
        @endif
    </div>
    <div>
        <h3 class="text-lg my-4">Create an idea</h3>
        <a href="/ideas/create"
           class="cursor-pointer rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            Create idea
        </a>
    </div>
</x-layout>
