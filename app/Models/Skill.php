<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use LanguageToggle;
    protected $guarded = [];
    public $timestamps = false;

    public function seekers() {
        return $this->belongsToMany(Seeker::class);
    }
}
