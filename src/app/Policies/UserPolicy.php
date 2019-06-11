<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * ユーザー登録内容の編集、削除は記事のオーナーのみ
     * 
     * @param \App\User $user 現在のユーザー
     * @param \App\User $model このユーザーページのユーザー
     * @return mixed
     */
    public function update(User $user, User $model) {
        return $user->id === $model->id;
    }
}
