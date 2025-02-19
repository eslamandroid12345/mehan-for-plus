<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use LanguageToggle;
    protected $guarded = [];
    public $timestamps = false;

    public function ads() {
        return $this->hasMany(Ad::class);
    }
}
