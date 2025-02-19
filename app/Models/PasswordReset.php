<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'email';
}
