@props(["active" => false])

<a class="{{ $active ?  "bg-neutral-800" : "" }} rounded-md px-3 py-2"
   aria-current="{{ $active ? "page" : "false" }}"
   {{ $attributes }}
>
    {{ $slot }}
</a>
