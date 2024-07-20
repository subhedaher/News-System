<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Writer;
use Illuminate\Auth\Access\Response;

class WriterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Read-Writers');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Writer $writer): bool
    {
        return $user->hasPermissionTo('Read-Writers');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Writer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Writer $writer): bool
    {
        return $user->hasPermissionTo('Update-Writer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Writer $writer): bool
    {
        return $user->hasPermissionTo('Delete-Writer');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Writer $writer): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Writer $writer): bool
    {
        //
    }
}