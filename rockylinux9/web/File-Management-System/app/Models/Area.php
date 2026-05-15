<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
