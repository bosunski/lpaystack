<?php

namespace Unicodeveloper\Paystack\Model;

use Illuminate\Database\Eloquent\Model;

class PaystackEvent extends Model
{
    protected $fillable = [
        'payload', 'event'
    ];

    protected $casts = [
        'payload' => 'object',
    ];
}
