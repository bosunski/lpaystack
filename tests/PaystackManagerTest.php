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

namespace Xeviant\LaravelPaystack\Test;

use Illuminate\Config\Repository;
use Mockery;
use Xeviant\LaravelPaystack\PaystackFactory;
use Xeviant\LaravelPaystack\PaystackManager;
use Xeviant\Paystack\Client;

class PaystackManagerTest extends AbstractTestCase
{
    public function testCreateConnection()
    {
        $config = ['secretKey' => 'sk_123abc', 'publicKey' => 'pk_123abc'];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('paystack.default')->andReturn('main');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('main', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(PaystackFactory::class);

        $manager = new PaystackManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('paystack.connections')->andReturn(['main' => $config]);

        $config['name'] = 'main';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
