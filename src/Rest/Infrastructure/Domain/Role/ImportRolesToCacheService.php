<?php


namespace Rest\Infrastructure\Domain\Role;


use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Rest\Domain\Entity\Role;
use Rest\Infrastructure\Domain\Cache\RedisCacheService;

class ImportRolesToCacheService
{
    private $cache;

    /**
     * ImportRolesToCacheService constructor.
     *
     * @param RedisCacheService $cache
     */
    public function __construct(RedisCacheService $cache)
    {
        $this->cache          = $cache->getCache();
    }

    public function execute()
    {
        $cachedRoles = $this->cache->getItem('roles');
        if($cachedRoles->isHit()){
            $this->cache->delete('roles');
        }
        return 'Roles cache has been nullified. Next HTTP request will cache the roles';
    }
}
