<?php


namespace Rest\Application\Service\Role;


class ViewExtendedRolesForRoleRequest
{
    /**
     * @var null
     */
    private $roleDesignation;

    public function __construct(
        $roleDesignation = null
    )
    {
        $this->roleDesignation = $roleDesignation;
    }

    /**
     * @return null
     */
    public function getRoleDesignation()
    {
        return $this->roleDesignation;
    }
}
