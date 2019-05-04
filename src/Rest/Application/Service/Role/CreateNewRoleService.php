<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\InvalidParameterException;
use Rest\Infrastructure\Domain\Messages\NewRoleCreatedMessage;
use Transactional\Interfaces\TransactionalServiceInterface;

class CreateNewRoleService implements TransactionalServiceInterface
{
    private $roleRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var NewRoleCreatedMessage
     */
    private $message;

    public function __construct(
        EntityManagerInterface $em,
        NewRoleCreatedMessage $message
    ) {
        $this->roleRepository = $em->getRepository(Role::class);
        $this->em = $em;
        $this->message = $message;
    }

    /**
     * @param CreateNewRoleRequest $request
     *
     * @return Role
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null)
    {
        if ($request->getName() === '' || $request->getDesignation() === ''){
            throw new InvalidParameterException([
                'roleName' => $request->getName(),
                'roleDesignation' => $request->getDesignation()
            ]);
        }
        $role = new Role(
            $request->getDesignation(),
            $request->getName()
        );
        $this->roleRepository->persist($role);

        $this->message->publishMessage($role);

        return $role;
    }
}
