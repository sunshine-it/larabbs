<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

// 权限控制
class ReplyPolicy extends Policy
{

    public function destroy(User $user, Reply $reply)
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
