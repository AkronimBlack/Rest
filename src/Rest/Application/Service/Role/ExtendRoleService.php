<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;
use Transactional\Interfaces\TransactionalServiceInterface;

class ExtendRoleService implements TransactionalServiceInterface
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param ExtendRoleRequest $request
     */
    public function execute($request = null)
    {
        $roleToExtend = $this->roleRepository->findByReference($request->getRoleToExtend());
        if(!$roleToExtend){
            throw new NoSuchRoleException(['role_designation' => $request->getRoleToExtend()]);
        }

        foreach ($request->getRolesBeingExtended() as $extendedRoles){

            $roleBeingExtended = $this->roleRepository->findByReference($extendedRoles['designation']);
            if(!$roleBeingExtended){
                throw new NoSuchRoleException(['role_designation' => $extendedRoles['designation']]);
            }
            $roleToExtend->addParentRole($roleBeingExtended);
        }

    }
}
