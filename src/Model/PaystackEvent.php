<?php

namespace Unicodeveloper\Paystack\Model;

use Illuminate\Database\Eloquent\Model;

class PaystackEvent extends Model
{
    protected $table = "laravel_paystack_events";

    protected $fillable = [
        'payload', 'event'
    ];

    protected $casts = [
        'payload' => 'object',
    ];
}
