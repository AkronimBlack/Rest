<?php


namespace Rest\Infrastructure\Domain\Role;


use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class ImportRolesToCacheService
{
    private $redis;
    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    public function execute()
    {
        $this->cache = new RedisAdapter(
            RedisAdapter::createConnection('redis://rest-redis')
        );
        $test = $this->cache->getItem('test');
        $test->set('testing value');
        $this->cache->save($test);
//        $productsCount = $this->cache->getItem('stats.products_count');
//        if (!$productsCount->isHit()) {
//            $productsCount->set(4711);
//            $this->cache->save($productsCount);
//        }

//        return $productsCount->get();
    }
}
