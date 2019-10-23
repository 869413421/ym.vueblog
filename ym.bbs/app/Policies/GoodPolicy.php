<?php

namespace App\Policies;

use App\Models\User;
use App\Good;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goods.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the good.
     *
     * @param  \App\Models\User $user
     * @param  \App\Good $good
     * @return mixed
     */
    public function view(User $user, Good $good)
    {
        //
    }

    /**
     * Determine whether the user can create goods.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the good.
     *
     * @param  \App\Models\User $user
     * @param  \App\Good $good
     * @return mixed
     */
    public function update(User $user, Good $good)
    {
        return $user->isAuthorOf($good);
    }

    /**
     * Determine whether the user can delete the good.
     *
     * @param  \App\Models\User $user
     * @param  \App\Good $good
     * @return mixed
     */
    public function delete(User $user, Good $good)
    {
        return $user->isAuthorOf($good);
    }

    /**
     * Determine whether the user can restore the good.
     *
     * @param  \App\Models\User $user
     * @param  \App\Good $good
     * @return mixed
     */
    public function restore(User $user, Good $good)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the good.
     *
     * @param  \App\Models\User $user
     * @param  \App\Good $good
     * @return mixed
     */
    public function forceDelete(User $user, Good $good)
    {
        //
    }
}
