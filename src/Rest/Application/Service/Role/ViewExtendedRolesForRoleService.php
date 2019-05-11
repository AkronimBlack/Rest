<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;

class ViewExtendedRolesForRoleService
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param ViewExtendedRolesForRoleRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $role= $this->roleRepository->findByReference($request->getRoleDesignation());

        if(!$role){
            throw new NoSuchRoleException(['designation' => $request->getRoleDesignation()]);
        }


        $roles = $this->roleRepository->findAll();

        $returnArray = [];
        foreach ($roles as $aRole){
//            /**
//             * @var Role $parentRole
//             */
//            foreach ($role->getParentRoles() as $parentRole){
//                $extends = false;
//                if($parentRole === $aRole){
//                    $extends = true;
//                }
//            }
            $extends = false;
            if($role->getParentRoles()->contains($aRole)){
                $extends = true;
            }

            $returnArray[] = [
                'id' => $aRole->getId(),
                'name' => $aRole->getName(),
                'designation' => $aRole->getRole(),
                'extends' => $extends
            ];
        }

        return $returnArray;

    }
}
