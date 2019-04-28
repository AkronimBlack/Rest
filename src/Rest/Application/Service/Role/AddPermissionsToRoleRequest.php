<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:27
 */

namespace Rest\Application\Service\Role;


class AddPermissionsToRoleRequest
{
    private $roleId;
    /**
     * @var array
     */
    private $permissions;

    public function __construct(
        $roleId,
        array $permissions = null
    )
    {
        $this->roleId = $roleId;
        $this->permissions = $permissions;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
