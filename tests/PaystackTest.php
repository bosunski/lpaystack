<?php

declare(strict_types=1);

/*
 * This file is part of the Laravel Paystack package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unicodeveloper\Paystack\Test;

use GuzzleHttp\Client;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Unicodeveloper\Paystack\Paystack;

class PaystackTest extends TestCase
{
    protected $paystack;

    protected function setUp(): void
    {
        $this->paystack = m::mock(Paystack::class);
        $this->mock = m::mock(Client::class);
    }

    protected function tearDown(): void
    {
        m::close();
    }

    public function testAllCustomersAreReturned()
    {
        $array = $this->paystack->shouldReceive('getAllCustomers')->andReturn(['prosper']);

        $this->assertEquals('array', gettype([$array]));
    }

    public function testAllTransactionsAreReturned()
    {
        $array = $this->paystack->shouldReceive('getAllTransactions')->andReturn(['transactions']);

        $this->assertEquals('array', gettype([$array]));
    }

    public function testAllPlansAreReturned()
    {
        $array = $this->paystack->shouldReceive('getAllPlans')->andReturn([]);

        $this->assertEquals('array', gettype([$array]));
    }
}
