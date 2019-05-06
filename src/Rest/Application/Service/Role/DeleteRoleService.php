<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;
use Transactional\Interfaces\TransactionalServiceInterface;

class DeleteRoleService implements TransactionalServiceInterface
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param DeleteRoleRequest $request
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null)
    {
        $role = $this->roleRepository->find($request->getId());
        if ( ! $role) {
            throw new NoSuchRoleException(['id' => $request->getId()]);
        }

        $this->roleRepository->remove($role);

    }
}
