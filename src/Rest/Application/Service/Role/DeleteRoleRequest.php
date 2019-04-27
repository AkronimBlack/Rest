<?php


namespace Rest\Application\Service\Role;


class DeleteRoleRequest
{
    private $designation;

    public function __construct(
        $designation
    )
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }
}
