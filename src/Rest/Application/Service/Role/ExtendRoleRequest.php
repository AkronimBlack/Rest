<?php


namespace Rest\Application\Service\Role;


class ExtendRoleRequest
{
    private $roleToExtend;
    private $roleBeingExtended;

    public function __construct(
        $roleToExtend,
        $roleBeingExtended
    )
    {
        $this->roleToExtend = $roleToExtend;
        $this->roleBeingExtended = $roleBeingExtended;
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
    public function getRoleBeingExtended()
    {
        return $this->roleBeingExtended;
    }


}
