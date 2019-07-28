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

namespace Xeviant\LaravelPaystack\Helpers;

trait HelpsRequest
{
    public function addRequestData(array $args)
    {
        foreach ($args as $key => $data) {
            request()->request->add([$key => $data]);
        }
    }
}
