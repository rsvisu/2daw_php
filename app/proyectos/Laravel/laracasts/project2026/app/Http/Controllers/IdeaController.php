<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Idea::all();
        // $ideas = Idea::where('state', 'pending')->get();
        // $ideas = \Illuminate\Support\Facades\DB::select('SELECT * FROM ideas WHERE state = ?', ['pending']);

        return view('ideas.index', [
            'ideas' => $ideas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request $request es inyectado automáticamente por Laravel
        // Es equivalente a usar la función helper request() que usábamos en las rutas
        // $request->input('description') es lo mismo que request('description')

        // Validaciones
        $request->validate([
            'description' => ['required', 'min:10', 'max:255']
        ]);

        // Si llega aqui es porque las validaciones son correctas
        $description = $request->input('description');
        Idea::create([
            'description' => $description,
            'state' => 'pending'
        ]);
        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Forma manual con $id:
        // - Recibimos el id como parámetro de la URL
        // - Nosotros hacemos la búsqueda con findOrFail($id)
        // - Tenemos más control sobre cómo buscar el modelo
        // - En la ruta usamos: Route::get('/ideas/{id}', ...)

        // $idea = Idea::find($id);
        // $ideas = Idea::where('id', $id)->first();
        $idea = Idea::findOrFail($id);

        /*
        // 404
        if (is_null($idea)) {
            abort(404);
        }
        */

        return view('ideas.show', [
            'idea' => $idea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        // Route Model Binding con Idea $idea:
        // - Laravel automáticamente busca el modelo por el id de la URL
        // - Si no lo encuentra, lanza 404 automáticamente
        // - Es más limpio pero menos control
        // - En la ruta usamos: Route::get('/ideas/{idea}/edit', ...)
        // - El nombre del parámetro en la ruta {idea} debe coincidir con el nombre de la variable $idea
        // - No necesitamos hacer findOrFail, Laravel ya nos da el modelo

        return view('ideas.edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Forma manual con $id

        // ¿Cómo sabe Laravel qué valor asignar a cada parámetro?
        //
        // 1. Request $request -> Laravel detecta el "tipo" (Request) y automáticamente
        //    inyecta el objeto con los datos de la petición HTTP (formulario, headers, etc.)
        //    Esto se llama "Dependency Injection" (inyección de dependencias)
        //    Antes usábamos request('description'), ahora usamos $request->input('description')
        //    Es lo mismo, pero más limpio y testeable
        //
        // 2. $id -> Laravel lo asigna por el NOMBRE del parámetro en la ruta
        //    En la ruta tenemos: Route::patch('/ideas/{id}', ...)
        //    El {id} de la ruta coincide con el nombre $id aquí
        //
        // El ORDEN no importa para la inyección de dependencias (Request),
        // pero sí importa que el NOMBRE coincida para los parámetros de ruta ($id)

        // Recuperamos descripción del formulario
        $description = $request->input('description');
        // Buscamos idea por id y actualizamos descripción
        $idea = Idea::findOrFail($id);
        $idea->update([
            'description' => $description
        ]);

        /* Tambien se puede hacer así:
        $idea->description = $description;
        $idea->save();
        */

        return redirect("/ideas/{$idea->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // Route Model Binding con Idea $idea
        // Laravel ya nos pasa el modelo, solo lo eliminamos
        $idea->delete();

        return redirect('/ideas');
    }
}
