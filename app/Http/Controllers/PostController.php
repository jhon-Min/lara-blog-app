<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(isset(request()->search), function ($query){
            $search = request()->search;
            $query->where('title', "LIKE", "%$search%")->orWhere('description', "LIKE", "%$search%");
        })->latest('id')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([
            "title" => "required|min:3|max:255",
            "category" => "required|integer|exists:categories,id",
            "description" => "required|min:10"
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->except = Str::words($request->description, 20);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        $post->is_publish = true;
        $post->save();

        return redirect()->route('post.index')->with('status', 'Post create success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([
            "title" => "required|min:3|unique:posts,title,$post->id|max:255",
            "category" => "required|integer|exists:categories,id",
            "description" => "required|min:10"
        ]);

       $post->title = $request->title;
       $post->slug = Str::slug($request->title);
       $post->description = $request->description;
       $post->except = Str::words($request->description,20);
       $post->category_id = $request->category;
       $post->update();

       return redirect()->route('post.index')->with('status', 'Update Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('delStatus', "Deleted!");
    }
}
