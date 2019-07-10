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

namespace Xeviant\LaravelPaystack\Http;

use GrahamCampbell\CachePlugin\CachePlugin;
use Http\Client\Common\Plugin\Cache\Generator\CacheKeyGenerator;
use Psr\Cache\CacheItemPoolInterface;
use Xeviant\Paystack\HttpClient\Builder;

class ClientBuilder extends Builder
{
    /**
     * Adds Cache Plugin to builder.
     *
     * @param CacheItemPoolInterface $cacheItemPool
     * @param array                  $config
     *
     * @throws \ReflectionException
     */
    public function addCache(CacheItemPoolInterface $cacheItemPool, array $config = [])
    {
        $this->setCachePlugin($cacheItemPool, $config['generator'] ?? null, $config['lifetime'] ?? null);

        $this->setPropertyValue('httpClientModified', true);
    }

    /**
     * Add a cache plugin to cache responses locally.
     *
     * @param CacheItemPoolInterface $cacheItemPool
     * @param CacheKeyGenerator|null $generator
     * @param int|null               $lifetime
     *
     * @throws \ReflectionException
     */
    protected function setCachePlugin(CacheItemPoolInterface $cacheItemPool, CacheKeyGenerator $generator = null, int $lifetime = null): void
    {
        $stream = $this->getPropertyValue('streamFactory');

        $this->setPropertyValue('cachePlugin', new CachePlugin($cacheItemPool, $stream, $generator, $lifetime));
    }

    /**
     * Retrieves the value of a builder property.
     *
     * @param string $name
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    protected function getPropertyValue(string $name)
    {
        return static::getProperty($name)->getValue($this);
    }

    /**
     * Sets the value of a builder property.
     *
     * @param string $name
     * @param $value
     *
     * @throws \ReflectionException
     */
    protected function setPropertyValue(string $name, $value)
    {
        return static::getProperty($name)->setValue($this, $value);
    }

    /**
     * Gets the builder reflection property for the given name.
     *
     * @param string $name
     *
     * @throws \ReflectionException
     *
     * @return \ReflectionProperty
     */
    protected static function getProperty(string $name)
    {
        $prop = (new \ReflectionClass(Builder::class))->getProperty($name);

        $prop->setAccessible(true);

        return $prop;
    }
}
