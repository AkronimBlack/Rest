<?php

namespace Rest\Application\Service\Role;


class ViewPermissionsOfRoleRequest
{
    private $roleDesignation;

    public function __construct(
        $roleDesignation
    )
    {
        $this->roleDesignation = $roleDesignation;
    }

    /**
     * @return mixed
     */
    public function getRoleDesignation()
    {
        return $this->roleDesignation;
    }
}
