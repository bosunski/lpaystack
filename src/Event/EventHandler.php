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

namespace Xeviant\LaravelPaystack\Event;

use League\Event\EventInterface;
use Xeviant\Paystack\Event\EventPayload;

class EventHandler
{
    public function handle(EventInterface $event, EventPayload $payload): void
    {
        app('events')->dispatch($event->getName(), $payload);
    }
}
