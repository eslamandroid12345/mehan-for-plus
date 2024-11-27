<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function field() {
        return $this->belongsTo(Field::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function views() {
        return $this->hasMany(ProfileView::class);
    }

    public function isFavorite($seeker_id) {
        return $this->whereHas('favorites', function ($query) use ($seeker_id) {
            $query->where('company_id', $this->id);
            $query->where('seeker_id', $seeker_id);
        })->exists();
    }
}
