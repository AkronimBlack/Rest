<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:33
 */

namespace Rest\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Domain\Entity\Permission;
use Rest\Domain\Entity\Role;
use Rest\Domain\Services\Exceptions\NoSuchRoleException;

class ViewPermissionsOfRoleService
{
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param ViewPermissionsOfRoleRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $role = $this->roleRepository->findByReference($request->getRoleDesignation());
        if(!$role){
            throw new NoSuchRoleException(['reference' => $request->getRoleDesignation()]);
        }
        $permissionArray = [];
        /**
         * @var Permission $permission
         */
        foreach ($role->getPermissions() as $permission){
            $permissionArray[] = [
                'name' => $permission->getName(),
                'type' => $permission->getType(),
                'route' => $permission->getRoute()
            ];
        }
        return $permissionArray;
    }
}
