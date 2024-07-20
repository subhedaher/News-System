<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Read-Articles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Article $article): bool
    {
        return $user->hasPermissionTo('Read-Articles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Article');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Article $article): bool
    {
        return $user->hasPermissionTo('Update-Article');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Article $article): bool
    {
        return $user->hasPermissionTo('Delete-Article');
    }

    /**
     * Determine whether the user can trash the model.
     */
    public function trash($user): bool
    {
        return $user->hasPermissionTo('Trash-Articles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, $article): bool
    {
        return $user->hasPermissionTo('Restore-Article');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, $article): bool
    {
        return $user->hasPermissionTo('ForceDelete-Article');
    }
}
