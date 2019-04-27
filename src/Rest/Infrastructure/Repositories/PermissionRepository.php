<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 16:09
 */

namespace Rest\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;
use Rest\Domain\Entity\Permission;

class PermissionRepository extends EntityRepository
{
    public function findByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByRoute(string $route)
    {
        return $this->findOneBy(['route' => $route]);
    }

    public function add(Permission $permission): void
    {
        $this->getEntityManager()->persist($permission);
    }
    public function remove(Permission $permission): void
    {
        $this->getEntityManager()->remove($permission);
    }

    public function findByNameAndMethod($name , $method)
    {
        return $this->findOneBy(['name' => $name , 'type' => $method]);
    }
}
