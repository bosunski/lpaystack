<?php

declare(strict_types=1);

/**
 * This file is part of the Xeviant Laravel Paystack package.
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

namespace Xeviant\LaravelPaystack\Facades;

use Illuminate\Support\Facades\Facade;

class Paystack extends Facade
{
    /**
     * Get the registered name of the Class.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'xeviant.paystack';
    }
}
