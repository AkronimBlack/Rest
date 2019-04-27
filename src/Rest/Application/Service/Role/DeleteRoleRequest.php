<?php


namespace Rest\Application\Service\Role;


class DeleteRoleRequest
{
    private $id;

    public function __construct(
        $id
    )
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
