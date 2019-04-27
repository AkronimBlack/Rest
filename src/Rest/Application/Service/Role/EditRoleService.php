<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;
use Transactional\Interfaces\TransactionalServiceInterface;

class EditRoleService implements TransactionalServiceInterface
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param EditRoleRequest $request
     */
    public function execute($request = null)
    {
        $role = $this->roleRepository->find($request->getId());
        if(!$role){
            throw new NoSuchRoleException(['id' => $request->getId()]);
        }
        $role->setName($request->getName());
        $role->setRole($request->getDesignation());
    }
}
