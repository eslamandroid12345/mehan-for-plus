<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use LanguageToggle;
    protected $guarded = [];
    public $timestamps = false;
    public function seekers() {
        return $this->hasMany(Seeker::class);
    }
}
