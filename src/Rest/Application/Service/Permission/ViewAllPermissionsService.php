<?php


namespace Rest\Application\Service\Permission;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Permission;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;

class ViewAllPermissionsService
{
    private $permissionRepository;

    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->permissionRepository = $em->getRepository(Permission::class);
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param ViewAllPermissionsRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $permissions = $this->permissionRepository->findAll();
        $permissionsArray = [];
        if($request->getRoleId()){
            $role = $this->roleRepository->find($request->getRoleId());
            if(!$role){
                throw new NoSuchRoleException(['role' => $request->getRoleId()]);
            }
        }

        foreach ($permissions as $permission){
            $hasPermission = false;
            if($request->getRoleId()){
                foreach ($role->getPermissions() as $existingPermission){
                    /** @var $existingPermission Permission */
                    if($existingPermission->getName() === $permission->getName()){
                        $hasPermission = true;
                        break;
                    }
                }
            }
            $permissionsArray[] = [
                'name' => $permission->getName(),
                'route' => $permission->getRoute(),
                'type' => $permission->getType(),
                'hasPermission' => $hasPermission
            ];
        }
        return $permissionsArray;
    }
}
