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
        // 管理者権限の人は無条件に許可
        if ($user->role_id == 1) {
            return true;
        }
        return $user->id === $model->id;
    }
}
