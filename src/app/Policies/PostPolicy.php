<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 投稿の編集、削除は記事のオーナーのみ
     * 
     * @param \App\User $user ログインしているユーザー
     * @param \App\Post $post 記事された記事
     * @return mixed
     */
    public function update(User $user, Post $post) {
        // 管理者権限の人は無条件に許可
        if ($user->role_id == 1) {
            return true;
        }
        return $user->id === $post->user_id;
    }
}
