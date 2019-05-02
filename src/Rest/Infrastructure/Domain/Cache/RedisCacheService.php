<?php


namespace Rest\Infrastructure\Domain\Cache;


use Symfony\Component\Cache\Adapter\RedisAdapter;

class RedisCacheService
{
    private $cache;

    public function __construct(
        $redisServerDns
    )
    {
        $this->cache = new RedisAdapter(
            RedisAdapter::createConnection($redisServerDns)
        );
    }

    /**
     * @return RedisAdapter
     */
    public function getCache(): RedisAdapter
    {
        return $this->cache;
    }
}
