<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tags = Tag::OrderBy('id', 'DESC')->paginate();
        return view('admin.tag.index', compact('tags'));
    }

    
    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->all());

        return redirect()->route('tags.edit', $tag->id)
                    ->with('success', 'Etiqueta creada existosamente');
    }

    public function show($id)
    {
        $tag = Tag::find($id);

        return view('admin.tag.show', compact('tag'));
    }

   
    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tag.edit', compact('tag'));
    }

  
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->fill($request->all())->save();

        return redirect()->route('tags.edit', $tag->id)
                        ->with('success','Etiqueta editada con éxito');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id)->delete();

        return back()->with('success','Etiqueta eliminada con éxito');
    }
}
