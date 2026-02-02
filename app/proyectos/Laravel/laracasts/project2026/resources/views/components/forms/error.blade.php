@props(['name'])
@error($name)
<p class="text-sm text-red-500 mt-4">{{ $message }}</p>
@enderror
