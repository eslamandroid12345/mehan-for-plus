<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use LanguageToggle;
    protected $guarded = [];
    public $timestamps = false;

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function ads() {
        return $this->hasMany(Ad::class, 'id', 'city_of_residence');
    }

    public function seekers() {
        return $this->hasMany(Seeker::class);
    }

    public function nameEn() : Attribute {
        return Attribute::get(function ($value){
            if($this->country->name_en !== 'Saudi Arabia') {
                return $this->country->name_en;
            } else {
                return $value;
            }
        });
    }

    public function nameAr() : Attribute {
        return Attribute::get(function ($value){
            if($this->country->name_ar !== 'المملكة العربية السعودية') {
                return $this->country->name_ar;
            } else {
                return $value;
            }
        });
    }
}
