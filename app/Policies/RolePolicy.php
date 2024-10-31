<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any roles.
     */
    public function viewAny(User $user): Response
    {
        //
    }

    /**
     * Determine whether the user can view a specific role.
     */
    public function view(User $user, Role $role): Response
    {
    }

    /**
     * Determine whether the user can assign or create roles.
     */
    public function create(User $user): Response
    {
    }

    /**
     * Determine whether the user can update a specific role.
     */
    public function update(User $user, Role $role): Response
    {
    }

    /**
     * Determine whether the user can delete a role.
     */
    public function delete(User $user, Role $role): Response
    {
    }

    /**
     * Determine whether the user can restore a deleted role.
     */
    public function restore(User $user, Role $role): Response
    {
    }

    /**
     * Determine whether the user can permanently delete a role.
     */
    public function forceDelete(User $user, Role $role): Response
    {
    }
}