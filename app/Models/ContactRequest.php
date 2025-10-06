<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'ticket',
    ];

    protected $casts = [
        'attachments' => 'array',
        'callback_requested' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($enquiry) {
            $enquiry->ticket = self::generateTicket();
        });
    }

    /**
     * Generate a unique ticket ID
     */
    public static function generateTicket()
    {
        do {
            $ticket = 'TKT-' . strtoupper(Str::random(8));
        } while (self::where('ticket', $ticket)->exists());

        return $ticket;
    }
}
