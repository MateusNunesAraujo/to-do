<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /* 
    index para mostrar todos los elementos
    store para guadar un todo
    update para actualizar
    destroy para eliminar todo
    edit para mostrar el formulario de edicion
    */

    public function store(Request $request)
    {
        
        $request->validate(['title' => 'required|min:3']);
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();
        return view('index', ['todos' => $todos, 'categories'=>$categories]);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        return view('show', ['todo' => $todo]);
    }


    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->title = $request->title; 
        $todo->save();
        /* return view('index', ['success' => 'Actualización exitosa','todos' => $todo]); */
        return redirect()->route('todos')->with('success', 'Tarea Actualizada correctamente');
    }

    public function destroy(Request $request, $id)
    {
       
        $todo = Todo::find($id);

            $todo->delete();
            return redirect()->route('todos')->with('success', 'Tarea Eliminada correctamente');
        
       
    }

}
