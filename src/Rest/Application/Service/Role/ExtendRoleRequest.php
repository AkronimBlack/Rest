<?php


namespace Rest\Application\Service\Role;


class ExtendRoleRequest
{
    private $roleToExtend;
    private $rolesBeingExtended;

    public function __construct(
        $roleToExtend,
        $rolesBeingExtended
    )
    {
        $this->roleToExtend = $roleToExtend;
        $this->rolesBeingExtended = $rolesBeingExtended;
    }

    /**
     * @return mixed
     */
    public function getRoleToExtend()
    {
        return $this->roleToExtend;
    }

    /**
     * @return mixed
     */
    public function getRolesBeingExtended()
    {
        return $this->rolesBeingExtended;
    }


}
