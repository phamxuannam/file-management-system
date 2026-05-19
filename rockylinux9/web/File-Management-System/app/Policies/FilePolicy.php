<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\File;
use App\Models\User;

class FilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user, File $file): bool
    {
        if($file->visibility === 3) return true;

        if(!$user) return false;

        if($user->id === $file->user_id) return true;

        return $user->hasRole('area_manager') && $user->area_id === $file->user->area_id;
    }

    public function download(?User $user, File $file): bool
    {
        if($file->visibility === 3) return true;

        if(!$user) return false;

        if($user->id === $file->user_id) return true;

        return $user->hasRole('area_manager') && $user->area_id === $file->user->area_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, File $file): bool{return false;}

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('file.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, File $file): bool
    {
        return  ($user->can('file.edit') && $user->id === $file->user_id) || 
                ($user->hasRole('area_manager') && $user->area_id === $file->user->area_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, File $file): bool
    {
        return  ($user->can('file.delete') && $user->id === $file->user_id) || 
                ($user->hasRole('area_manager') && $user->area_id === $file->user->area_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, File $file): bool{return false;}

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, File $file): bool{return false;}
}
