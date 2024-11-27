<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }
}
