<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function company() {
        $this->belongsTo(Company::class);
    }

    public function seeker() {
        $this->belongsTo(Seeker::class);
    }

}
