<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function seeker() {
        return $this->belongsTo(Seeker::class);
    }

    public function ad() {
        return $this->hasOne(Ad::class);
    }

}
