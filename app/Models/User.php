<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'profile_picture',
        'address_line',
        'city',
        'state',
        'country',
        'provider',
        'provider_id',
        'two_factor_enabled',
        'two_factor_type',
        'two_factor_code',
        'two_factor_expires_at',
        'role'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function wishlistItems()
{
    return $this->hasMany(Wishlist::class);
}
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPlatformRatingAttribute()
{
    $views = $this->activityLogs()->count();
    $orders = $this->orders()->count();

    // Weight metrics (adjust to your logic)
    $score = ($views * 0.01) + ($orders * 0.5);

    // Cap it to 5
    $rating = min(5, round($score, 1));

    return $rating ?: 0.0;
}

public function activityLogs()
{
    return $this->hasMany(UserActivityLog::class);
}

}
