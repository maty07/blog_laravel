<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = Category::OrderBy('id', 'DESC')->paginate();
        return view('admin.category.index', compact('categories'));
    }

    
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('categories.edit', $category->id)
                    ->with('success', 'Categoria creada existosamente');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('admin.category.show', compact('category'));
    }

   
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
    }

  
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)
                        ->with('success','Categoria editada con éxito');
    }


    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return back()->with('success','Categoria eliminada con éxito');
    }
}
