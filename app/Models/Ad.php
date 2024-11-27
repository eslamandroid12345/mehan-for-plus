<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    protected $casts = [
        'marital_status' => 'string'
    ];

//    public function residence() : Attribute {
//        return Attribute::make(get: function ($value) {
//            return $this->cityOfResidence->t('name') . ', ' . $this->cityOfResidence->country->t('name');
//        });
//    }

    public function seeker() {
        return $this->belongsTo(Seeker::class);
    }

    public function qualification() {
        return $this->belongsTo(Qualification::class);
    }

    public function latestTransaction() {
        return $this->belongsTo(Transaction::class, 'latest_transaction_id');
    }

    public function views() {
        return $this->hasMany(ProfileView::class);
    }

    public function scopeActive($query) {
        $query->where('is_active', 1);
    }

    public function scopeExpired($query) {
        $query->where('expiration_date', '<=', Carbon::now())->where('is_active', '1');
    }

    public function scopeWithoutTimestamps() {
        $this->timestamps = false;
        return $this;
    }
}
