<?php

/**
 * This file is part of the Xeviant Paystack package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @version         1.0
 *
 * @author          Olatunbosun Egberinde
 * @license         MIT Licence
 * @copyright       (c) Olatunbosun Egberinde <bosunski@gmail.com>
 *
 * @link            https://github.com/bosunski/lpaystack
 */

namespace Xeviant\LaravelPaystack\Model;

use Illuminate\Database\Eloquent\Model;

class PaystackEvent extends Model
{
    protected $table = 'laravel_paystack_events';

    protected $fillable = [
        'payload', 'event',
    ];

    protected $casts = [
        'payload' => 'object',
    ];
}
