<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:34
 */

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
