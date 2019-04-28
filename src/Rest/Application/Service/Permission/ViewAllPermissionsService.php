<?php


namespace Rest\Application\Service\Permission;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Permission;

class ViewAllPermissionsService
{
    private $permissionRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->permissionRepository = $em->getRepository(Permission::class);
    }

    /**
     * @param null $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $permissions = $this->permissionRepository->findAll();
        $permissionsArray = [];
        foreach ($permissions as $permission){
            $permissionsArray[] = [
                'name' => $permission->getName(),
                'route' => $permission->getRoute(),
                'type' => $permission->getType()
            ];
        }
        return $permissionsArray;
    }
}
