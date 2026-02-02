<x-layout title="Ideas">
    <x-slot:heading>
        Ideas
    </x-slot:heading>
    <h2 class="text-xl mb-5">Edit your idea #{{ $idea->id }}</h2>
    <form method="post" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <div class="col-span-full">
                    <label for="description" class="block text-white">Description</label>
                    <div class="mt-2">
                        <textarea id="description" name="description" rows="3"
                                  class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">{{ $idea->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                    class="cursor-pointer rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Update
            </button>
            <button type="submit"
                    form="delete-form"
                    class="cursor-pointer rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                Delete
            </button>
        </div>
    </form>
    <form action="/ideas/{{ $idea->id }}" method="post" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
