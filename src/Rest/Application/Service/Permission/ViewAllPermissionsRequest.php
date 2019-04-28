<?php


namespace Rest\Application\Service\Permission;


class ViewAllPermissionsRequest
{
    private $roleId;

    public function __construct(
        $roleId
    )
    {
        $this->roleId = $roleId;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->roleId;
    }
}
