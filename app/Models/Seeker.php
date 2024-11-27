<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeker extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function nationality() {
        return $this->belongsTo(Nationality::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function skills() {
        return $this->belongsToMany(Skill::class);
    }

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function ad() {
        return $this->hasOne(Ad::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function scopeResident($query) {
        $query->where('is_resident', 1);
    }

    public function scopeNonResident($query) {
        $query->where('is_resident', 0);
    }

}
