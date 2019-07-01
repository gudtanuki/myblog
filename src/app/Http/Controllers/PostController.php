<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePost;
use App\Post;
use App\Like;
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
        $posts = Post::orderByDesc('created_at')->paginate(10);
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
        return redirect('posts/'.$post->id)->with('status', 'Post created: ' . $post->title . '!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post  //$idのかわりに$idに一致するPostモデルのインスタンスを呼ぶ
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Auth::user()) {
            if (Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first()) {
                $like_or = Like::where('user_id', Auth::user()->id)->where('post_id', $post->id)->first();
            } else {
                $like_or = null;
            }
        } else {
            $like_or = null;
        }
        return view('posts.show', ['post' => $post, 'like_or' => $like_or]);
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
        return redirect('posts/' . $post->id)->with('status', 'Post updated: ' . $post->title . '!');
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

        // 関連するコメントを削除
        $comments = $post->comments();
        $comments->delete();

        $likes = $post->likes();
        $likes->delete();
        
        $post->delete();
        return redirect('/')->with('status', 'Post deleted!');
    }

    public function like_add(Request $request) {
        // 前のURLを取得
        $pass = url()->previous();
        // 取得したURLから数字のみ（つまりpost.id）を取得
        $post_id = preg_replace('/[^0-9]/', '', $pass);
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $post_id;
        $like->save();
        $like_count = Like::where('post_id', $post_id)->count();
        return $like_count;
    }

    public function like_destroy(Request $request) {
        // 前のURLを取得
        $pass = url()->previous();
        // 取得したURLから数字のみ（つまりpost.id）を取得
        $post_id = preg_replace('/[^0-9]/', '', $pass);
        $user_id = Auth::user()->id;
        $like = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();
        $like->delete();

        $like_count = Like::where('post_id', $post_id)->count();
        return $like_count;
    }
}
