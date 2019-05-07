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

    private $parentRoles;

    private $childrenRoles;
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

        $this->parentRoles = new ArrayCollection();
        $this->childrenRoles = new ArrayCollection();
    }

    /**
     * @param Role $role
     */
    public function addParentRole(Role $role): void
    {
        if(!$role->getChildrenRoles()->contains($this)){
            $role->addChildrenRole($this);
        }
        $this->parentRoles[] = $role;
    }

    /**
     * @param Role $role
     */
    public function addChildrenRole(Role $role): void
    {
        if(!$role->getParentRoles()->contains($this)){
            $role->addParentRole($this);
        }
        $this->childrenRoles[] = $role;
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
        $permission->addRole($this);
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

    /**
     * @param string $role
     *
     * @return Role
     */
    public function setRole(string $role): Role
    {
        $this->role = $role;

        return $this;
}

    /**
     * @param string $name
     *
     * @return Role
     */
    public function setName(string $name): Role
    {
        $this->name = $name;

        return $this;
}

    /**
     * @return PersistentCollection
     */
    public function getParentRoles(): PersistentCollection
    {
        return $this->parentRoles;
    }

    /**
     * @return PersistentCollection
     */
    public function getChildrenRoles(): PersistentCollection
    {
        return $this->childrenRoles;
    }
}
