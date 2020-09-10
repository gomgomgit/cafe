<?php

namespace App\Policies;

use App\Model\User;
use App\Model\Variant;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantPolicy
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
        return !($user->role == 'employee');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Variant  $variant
     * @return mixed
     */
    public function view(User $user, Variant $variant)
    {
        //
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
     * @param  \App\Model\Variant  $variant
     * @return mixed
     */
    public function update(User $user, Variant $variant)
    {
        return !($user->role == 'employee') && !($variant->id == 1);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Variant  $variant
     * @return mixed
     */
    public function delete(User $user, Variant $variant)
    {
        return !($user->role == 'employee') && !($variant->id == 1);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Variant  $variant
     * @return mixed
     */
    public function restore(User $user, Variant $variant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Variant  $variant
     * @return mixed
     */
    public function forceDelete(User $user, Variant $variant)
    {
        //
    }
}
