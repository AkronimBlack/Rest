<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 10-Jan-19
 * Time: 19:39
 */

namespace Rest\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Role
{
    const STARTER_ROLE = 'ROLE_USER';
    const ANON_ROLE = 'ROLE_ANON';
    const ADMIN_ROLE = 'ROLE_ADMIN';

    private $id;
    /**
     * @var string
     */
    private $role;
     /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $permissions;

    /**
     * Role constructor.
     * @param string $role
     * @param string $name
     */
    public function __construct(
        string $role,
        string $name
    )
    {
        $this->role = $role;
        $this->permissions = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @return PersistentCollection
     */
    public function getPermissions(): PersistentCollection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): Role
    {
        $this->permissions[] = $permission;
        return $this;
    }


    public function hasPermission(string $route , string $method)
    {
        foreach ($this->getPermissions() as $permission){
            if($permission->getRoute() === $route && $permission->getType() === $method){
                return $permission;
            }
        }
        return false;
    }


    /**
     * @return mixed
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return PersistentCollection
     */
    public function getUsers(): PersistentCollection
    {
        return $this->users;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
