<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;


class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = Post::OrderBy('id', 'DESC')
                ->where('user_id', auth()->user()->id)
                ->paginate();
        return view('admin.post.index', compact('posts'));
    }

    
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->all());

        //IMAGE
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('img', $request->file('file'));
            $post->fill(['file' => asset($path)])->save();
        }
        
        //TAGS
        $post->tags()->sync($request->get('tags'));
        
        return redirect()->route('posts.create', $post->id)
                       ->with('success', 'Entrada creada existosamente');
    }
   
    public function edit($id)
    {
        $post = Post::find($id); 
        $this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')->pluck('name','id');
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.post.edit', compact('post','categories','tags'));
    }

  
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);
            $post->fill($request->all())->save();

      

         if ($request->file('file')) {
            $path = Storage::disk('public')->put('img', $request->file('file'));
            $post->fill(['file' => asset($path)])->save();
        }
        
        //TAGS
        $post->tags()->sync($request->get('tags'));


        return redirect()->route('posts.edit', $post->id)
                        ->with('success','Entrada editada con éxito');
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);
        $post->delete();

        return back()->with('success','Entrada eliminada con éxito');
    }
}
