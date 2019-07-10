<?php

declare(strict_types=1);

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

namespace  Xeviant\LaravelPaystack\Test;

use Xeviant\LaravelPaystack\PaystackFactory;
use Xeviant\LaravelPaystack\PaystackManager;
use Xeviant\Paystack\Client;

class PaystackServiceProviderTest extends AbstractTestCase
{
    public function testIfPaystackFactoryIsInjectable()
    {
        $this->assertIsInjectable(PaystackFactory::class);
    }

    public function testIfPaystackManagerIsInjectable()
    {
        $this->assertIsInjectable(PaystackManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['paystack.connection'];
        $this->app['xeviant.paystack']->reconnect();
        $new = $this->app['paystack.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
