<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use LanguageToggle;
    protected $guarded = [];
    public $timestamps = false;
    public function companies() {
        return $this->hasMany(Company::class);
    }
}
