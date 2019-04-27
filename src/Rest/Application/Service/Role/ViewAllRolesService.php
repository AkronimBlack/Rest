<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:27
 */

namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;

class ViewAllRolesService
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param ViewAllRolesRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $roles = $this->roleRepository->findAll();
        $roleArray = [];
        foreach ($roles as $role){
            $roleArray[] = [
                'id' => $role->getId(),
                'name' => $role->getName(),
                'designation' => $role->getRole()
            ];
        }
        return $roleArray;
    }
}
