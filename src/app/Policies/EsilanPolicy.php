<?php

namespace App\Policies;

use App\User;
use App\Esilan;
use Illuminate\Auth\Access\HandlesAuthorization;

class EsilanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the esilan.
     *
     * @param  \App\User  $user
     * @param  \App\Esilan  $esilan
     * @return mixed
     */
    public function view(User $user, Esilan $esilan)
    {
        //
    }

    /**
     * Determine whether the user can create esilans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the esilan.
     *
     * @param  \App\User  $user
     * @param  \App\Esilan  $esilan
     * @return mixed
     */
    public function update(User $user, Esilan $esilan)
    {
        //
    }

    /**
     * Determine whether the user can delete the esilan.
     *
     * @param  \App\User  $user
     * @param  \App\Esilan  $esilan
     * @return mixed
     */
    public function delete(User $user, Esilan $esilan)
    {
        //
    }
}
