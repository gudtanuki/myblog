<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ログインしてない場合、UserControllerはindexとshowのみ
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
        $users = User::orderByDesc('created_at')->paginate(5);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->posts = $user->posts()->orderByDesc('updated_at')->paginate(5);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        // ValidateUserの'name'部分だけ使用する
        $request->validate([
            'name' => (new ValidateUser())->rules()['name']
        ]);
        if ($user->email !== $request->email) {
            $request->validate([
                'email' => (new ValidateUser())->rules()['email']
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('users/' . $user->id)->with('status', 'Your profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('update', $user);

        // 関連するコメントを削除
        // コメント削除用にpostsをarrayで取得
        $posts = $user->posts;
        foreach ($posts as $key => $post) {
            // commentsを一括削除するときは、$post->commentsではなく、$post->comments()
            // 逆に、$user->posts()をforeachしようとすると、usersに関連するpostを一つずつ取ってこれない
            $comments = $post->comments();
            $comments->delete();
        }

        $likes = $user->likes();
        $likes->delete();

        // 関連する投稿を削除
        // postsを一括削除するときは、$user->postsではなく、$user->posts()
        $users_posts = $user->posts();
        $users_posts->delete();
        
        $user->delete();
        return redirect('/')->with('status', 'Your account deleted!');
    }
}
