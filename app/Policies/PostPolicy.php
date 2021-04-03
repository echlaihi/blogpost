<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function manage(User $user,Post $post)
    {
        return ($post->user_id == $user->id) or ($user->is_admin);
    }
}
