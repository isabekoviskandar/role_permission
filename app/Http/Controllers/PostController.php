<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(15);
        return view('post.posts',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.post_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request){



        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');  // stores in `storage/app/public/images`
        }

        Post::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $imagePath,
            'count' => $request->input('count'),
            'premium' => $request->input('premium', 0), 
        ]);

        return redirect()->route('post.index')->with('success', 'Item created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.post_show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // dd($post);
        return view('post.post_edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request,$id)
    {

        $post = Post::findOrFail($id);

        $post->name = $request->input('name');
        $post->price = $request->input('price');
        $post->count = $request->input('count');
        $post->premium = $request->input('premium');

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $imagePath = $request->file('image')->store('images/posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Post updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post){
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Post deleted successfully!');            
        }
        return redirect()->route('post.index')->with('error', 'Error While Deleting Post!');

    }
}
