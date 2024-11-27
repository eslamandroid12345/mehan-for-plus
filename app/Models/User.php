<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'name',
        'email',
        'password',
        'phone',
        'is_phone_public',
        'image',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if(is_null($value)) {
                    $value = Cache::rememberForever('default_profile_image', function () {
                        return Setting::query()->where('key', 'default_profile_image')->pluck('value')->first();
                    });
                    return ($value);
                }
                return $value;
            }
        );
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    public function seeker() {
        return $this->hasOne(Seeker::class);
    }

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function chatRooms() {
        return $this->hasMany(ChatRoomsUser::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
    }

    public function chatMessages() {
        return $this->hasMany(ChatMessage::class);
    }

    public function scopeCurrent($query) {
        $query->where('id', auth('api')->user()->id);
    }
}
