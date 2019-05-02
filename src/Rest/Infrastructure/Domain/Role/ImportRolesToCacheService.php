<?php


namespace Rest\Infrastructure\Domain\Role;


use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Rest\Domain\Entity\Role;
use Rest\Infrastructure\Domain\Cache\RedisCacheService;

class ImportRolesToCacheService
{
    private $cache;

    private $roleRepository;

    /**
     * ImportRolesToCacheService constructor.
     *
     * @param RedisCacheService $cache
     * @param EntityManagerInterface $em
     */
    public function __construct(RedisCacheService $cache, EntityManagerInterface $em)
    {
        $this->cache          = $cache->getCache();
        $this->roleRepository = $em->getRepository(Role::class);
    }

    public function execute()
    {
        $cachedRoles = $this->cache->getItem('roles');
        if($cachedRoles->isHit()){
            $this->cache->delete('roles');
        }
        $roles = $this->roleRepository->findAll();
        $cachedRoles->set($roles);
        $this->cache->save($cachedRoles);
        return $cachedRoles;
    }
}
