<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * ログインしてない場合のアクション制限
     */
    public function __construct()
    {
        $this->middleware('auth')->except(array(
            'index',
            'show'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('posts.index', ['posts' => $posts]);
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
     * @param  \App\Http\Requests\ValidatePost $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePost $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        if ($request->image !== null) {
            $post->image = base64_encode(file_get_contents($request->image->getRealPath()));
        }
        $post->save();
        return redirect('posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post  //$idのかわりに$idに一致するPostモデルのインスタンスを呼ぶ
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ValidatePost $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePost $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->image !== null) {
            $post->image = base64_encode(file_get_contents($request->image->getRealPath()));
        } elseif($request->noimage) {
            $post->image = null;
        }
        $post->save();
        return redirect('posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->delete();
        return redirect('posts');
    }
}
