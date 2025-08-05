<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'role',
        'subject',
        'message',
        'contact_type_title',
        'contact_type_description',
        'priority',
        'attachments',
        'callback_requested',
        'callback_time',
        'callback_timezone',
    ];

    protected $casts = [
        'attachments' => 'array',
        'callback_requested' => 'boolean',
    ];

}
