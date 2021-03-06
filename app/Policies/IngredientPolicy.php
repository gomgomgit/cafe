<?php

namespace App\Policies;

use App\Model\Ingredient;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngredientPolicy
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
     * @param  \App\Model\Ingredient  $ingredient
     * @return mixed
     */
    public function view(User $user, Ingredient $ingredient)
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
     * @param  \App\Model\Ingredient  $ingredient
     * @return mixed
     */
    public function update(User $user, Ingredient $ingredient)
    {
        return !($user->role == 'employee') && !($size->id == 1);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Ingredient  $ingredient
     * @return mixed
     */
    public function delete(User $user, Ingredient $ingredient)
    {
        return !($user->role == 'employee') && !($size->id == 1);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Ingredient  $ingredient
     * @return mixed
     */
    public function restore(User $user, Ingredient $ingredient)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Ingredient  $ingredient
     * @return mixed
     */
    public function forceDelete(User $user, Ingredient $ingredient)
    {
        //
    }
}
