<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;
use Rest\Infrastructure\Domain\Messages\RoleHasBeenDeletedMessageService;
use Transactional\Interfaces\TransactionalServiceInterface;

class DeleteRoleService implements TransactionalServiceInterface
{
    private $roleRepository;
    /**
     * @var RoleHasBeenDeletedMessageService
     */
    private $messageService;

    public function __construct(
        EntityManagerInterface $em,
        RoleHasBeenDeletedMessageService $messageService
    ) {
        $this->roleRepository = $em->getRepository(Role::class);
        $this->messageService = $messageService;
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

        $this->messageService->publishMessage($role);
    }
}
