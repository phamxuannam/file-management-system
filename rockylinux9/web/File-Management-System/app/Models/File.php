<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class File extends Model
{
    protected $fillable = [
        'original_name',
        'file_name',
        'file_path',
        'mime_type',
        'size',
        'description',
        'visibility',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeVisibleTo(Builder $query, ?User $user): Builder{

        if(is_null($user))
            return $query->where('visibility', 3);
        
        if($user->hasRole('super_admin')) return $query;

        if($user->hasRole('area_manager')){
            return  $query->where(function (Builder $sql) use ($user){
                        $sql->whereHas('user', function($userQuery) use ($user) {
                            $userQuery->where('area_id', $user->area_id);
                        })
                        ->orWhere('visibility', 3);
                    });
        }

        return $query->where(function(Builder $sql) use ($user){
            $sql->where('user_id', $user->id)
                ->orWhere('visibility', 3);
        });

    }
}
