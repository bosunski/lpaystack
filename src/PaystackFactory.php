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

namespace Xeviant\LaravelPaystack;

use Closure;
use Illuminate\Contracts\Cache\Factory;
use Madewithlove\IlluminatePsrCacheBridge\Laravel\CacheItemPool;
use Xeviant\LaravelPaystack\Event\EventHandler;
use Xeviant\LaravelPaystack\Http\ClientBuilder;
use Xeviant\Paystack\App\PaystackApplication;
use Xeviant\Paystack\Client;
use Xeviant\Paystack\Config;
use Xeviant\Paystack\Contract\Config as PaystackConfigContract;
use Xeviant\Paystack\Exception\InvalidArgumentException;
use Xeviant\Paystack\HttpClient\Builder;

class PaystackFactory
{
    /**
     * Laravel Cache Instance.
     *
     * @var Factory
     */
    private $cache;

    /**
     * PaystackFactory constructor.
     *
     * @param Factory|null $cache
     */
    public function __construct(Factory $cache = null)
    {
        $this->cache = $cache;
    }

    /**
     * Creates A Paystack Client Object.
     *
     * @param array $config
     *
     * @throws \ReflectionException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return Client
     */
    public function make(array $config)
    {
        if ($this->secretKeyDoesNotExist($config)) {
            throw new InvalidArgumentException('You cannot use the Paystack Factory without a SECRET key, go into "config/paystack.php" to set one.');
        }

        $compatibleConfig = $this->createCompatibleConfiguration($config);

        $app = new PaystackApplication();

        $app->instance(Builder::class, $this->getBuilder($config));
        $app->instance(PaystackConfigContract::class, $compatibleConfig);

        $client = new Client($app);

        // We register a Global Event listener
        $client->getEvent()->listen('*', Closure::fromCallable([new EventHandler(), 'handle']));

        return $client;
    }

    /**
     * Check to see if Secret key doesn't exists.
     *
     * @param array $config
     *
     * @return bool
     */
    protected function secretKeyDoesNotExist(array $config)
    {
        return !array_key_exists('secretKey', $config) || (isset($config['secretKey']) && empty($config['secretKey']));
    }

    /**
     * Creates a Compatible Paystack Client Configuration from a configuration array.
     *
     * @param array $config
     *
     * @return Config
     */
    public function createCompatibleConfiguration(array $config)
    {
        return new Config(null, $config['publicKey'] ?: null, $config['secretKey'] ?: null, 'v1');
    }

    /**
     * Prepares and retrieves the Paystack client builder.
     *
     * @param $config
     *
     * @throws \ReflectionException
     *
     * @return ClientBuilder
     */
    protected function getBuilder($config)
    {
        $builder = new ClientBuilder();

        if ($this->cache && class_exists(CacheItemPool::class) && $cache = array_get($config, 'cache')) {
            $builder->addCache(new CacheItemPool($this->cache->store($cache === true ? null : $cache)));
        }

        return $builder;
    }
}
