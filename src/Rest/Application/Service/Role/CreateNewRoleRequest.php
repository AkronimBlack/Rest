<?php


namespace Rest\Application\Service\Role;


class CreateNewRoleRequest
{
    private $name;
    private $designation;

    public function __construct(
        $name,
        $designation
    )
    {

        $this->name = $name;
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
