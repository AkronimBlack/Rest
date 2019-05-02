<?php


namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\InvalidParameterException;
use Transactional\Interfaces\TransactionalServiceInterface;

class CreateNewRoleService implements TransactionalServiceInterface
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->roleRepository = $em->getRepository(Role::class);
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

        return $role;
    }
}
