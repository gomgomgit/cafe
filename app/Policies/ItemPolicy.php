<?php

namespace App\Policies;

use App\Model\Item;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !($user->role == 'employee');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Item  $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return !($user->role == 'employee');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Item  $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        return !($user->role == 'employee');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Item  $item
     * @return mixed
     */
    public function restore(User $user, Item $item)
    {
        return !($user->role == 'employee');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Item  $item
     * @return mixed
     */
    public function forceDelete(User $user, Item $item)
    {
        //
    }
}
