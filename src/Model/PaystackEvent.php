<?php

namespace Unicodeveloper\Model;

use Illuminate\Database\Eloquent\Model;

class PaystackEvent extends Model
{
    protected $fillable = [
        'payload', 'event'
    ];
}
