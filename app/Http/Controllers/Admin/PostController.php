<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$userId = Auth::id();
        //$user = Auth::user();

        $posts = Post::with('category', 'tags')->paginate(10);

        // $data = [
        //     'userId' => $userId,
        //     'user' => $user
        // ];

        return view('admin.post.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();
        
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        //controllo se l'utente ha cliccato delle checkbox
        if( array_key_exists('tags', $data) ){
            $newPost->tags()->sync( $data['tags'] );
        }

        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Post::findOrFail($id);
        $categories = Category::All();

        return view('admin.post.show', compact('item', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Post::findOrFail($id);
        $categories = Category::All();

        $tags = Tag::All();
        
        return view('admin.post.edit', compact('item', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Post::findOrFail($id);
        $item->update($data);

        //controlla se l'utente ha cliccato o erano già selezionate delle checkbox
        if(array_key_exists('tags', $data)){
            $item->tags()->sync( $data['tags'] );
        }else{
            //non ci sono checkbox selezionate
            $item->tags()->sync([]);
        }
        
        return redirect()->route('admin.post.show', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Post::findOrFail($id);
        $item->tags()->sync([]);
        $item->delete();
        
        return redirect()->route('admin.post.index');
    }
}
