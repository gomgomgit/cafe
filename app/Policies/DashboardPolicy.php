<?php

namespace App\Policies;

use App\Model\Dashboard;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
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
     * @param  \App\Model\Dashboard  $dashboard
     * @return mixed
     */
    public function view(User $user, Dashboard $dashboard)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Dashboard  $dashboard
     * @return mixed
     */
    public function update(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Dashboard  $dashboard
     * @return mixed
     */
    public function delete(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Dashboard  $dashboard
     * @return mixed
     */
    public function restore(User $user, Dashboard $dashboard)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Dashboard  $dashboard
     * @return mixed
     */
    public function forceDelete(User $user, Dashboard $dashboard)
    {
        //
    }
}
