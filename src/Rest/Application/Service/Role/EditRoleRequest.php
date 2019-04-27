<?php


namespace Rest\Application\Service\Role;


class EditRoleRequest
{
    private $id;
    private $name;
    private $designation;

    public function __construct(
        $id,
        $name,
        $designation
    ) {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
