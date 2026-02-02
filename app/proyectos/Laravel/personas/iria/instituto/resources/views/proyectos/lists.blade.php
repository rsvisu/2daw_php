<x-layouts.layout>
    <div class="overflow-x-auto h-96 p-5 ">
        <table class="table table-xs table-pin-rows table-pin-cols">
            <thead>
            <tr>
                @foreach($fields as $field)
                    <td class="text-lg">{{$field}}</td>

                @endforeach
            </tr>

            </thead>
            <tbody>
            <tr>


            @foreach($proyectos as $proyecto)
                <td class="text-base">{{$proyecto->name}}</td>
                <td class="text-base">{{$proyecto->description}}</td>
                <td class="text-base">{{$proyecto->hours}}</td>
                <td class="text-base">{{$proyecto->starting_date}}</td>
                <td class="btn bg-purple-400">Editar</td>
                <td>
                    <form action="{{route("proyecto.destroy",$proyecto->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn bg-purple-700">Eliminar</button>
                    </form>
                </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.layout>
