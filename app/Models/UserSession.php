<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class UserSession extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'ip_address', 'device', 'browser', 'platform',
        'location', 'last_active_at', 'is_current'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
