<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    public function ad() {
        return $this->belongsTo(Ad::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
