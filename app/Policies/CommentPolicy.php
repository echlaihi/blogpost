<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Comment;


class CommentPolicy
{
    use HandlesAuthorization;

   public function canManage(User $user, Comment $comment)
   {
       return ($user->id === $comment->user_id) or ($user->isAdmin);
   }
}
