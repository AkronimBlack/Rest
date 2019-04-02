<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 16:07
 */

namespace Settings\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Permission
{
    private $id;
    /**
     * @var PersistentCollection
     */
    private $roles;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $action;
    /**
     * @var string
     */
    private $method;

    public function __construct(
        string $name,
        string $action,
        string $method
    ) {
        $this->roles  = new ArrayCollection();
        $this->name   = $name;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * @return PersistentCollection
     */
    public function getRoles(): PersistentCollection
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    public function addRole(Role $role): Permission
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
