<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Authorize a user based on his user type.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function authorize(User $user)
    {
        if ($user->user_type === 'medico' || $user->user_type === 'admin')
            return true;
        else return false;
    }
    public function user_authorize(User $user)
    {
        if ($user->user_type === 'admin')
            return true;
        else return false;
    }
}
