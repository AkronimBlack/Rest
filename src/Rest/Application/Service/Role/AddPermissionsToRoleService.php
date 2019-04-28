<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:27
 */

namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Permission;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\MissingPermissionArgumentException;
use Rest\Domain\Services\Exceptions\NoSuchPermissionException;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;
use Transactional\Interfaces\TransactionalServiceInterface;

class AddPermissionsToRoleService implements TransactionalServiceInterface
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
     * @param AddPermissionsToRoleRequest $request
     */
    public function execute($request = null)
    {
        $role = $this->roleRepository->find($request->getRoleId());
        if(!$role){
            throw new NoSuchRoleException(['id' => $request->getRoleId()]);
        }
        foreach ($request->getPermissions() as $permission){
            if(!isset($permission['name'])){
                throw new MissingPermissionArgumentException(['name']);
            }
            $permission = $this->permissionRepository->findByName($permission['name']);
            if(!$permission){
                throw new NoSuchPermissionException(['name' => $permission['name']]);
            }
            $add = true;
            foreach ($role->getPermissions() as $existingPermission){
                if($existingPermission->getName() === $permission->getName()){
                    $add = false;
                }
            }
            if($add) {
                $role->addPermission($permission);
            }
        }
    }
}
