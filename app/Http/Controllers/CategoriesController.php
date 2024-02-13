<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color'=> 'required|max:7'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success','Nueva categoria agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::find($id);
        return view('categories.show',['categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success','Nueva categoria agregado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->todos()->each(function ($todo) {
            $todo->delete();
        });
        $category->delete();

        return redirect()->route('categories.index')->with('success','Categoria Eliminada');
    }
}
