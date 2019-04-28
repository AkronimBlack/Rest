<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:27
 */

namespace Rest\Application\Service\Role;


use Transactional\Interfaces\TransactionalServiceInterface;

class AddPermissionsToRoleService implements TransactionalServiceInterface
{
    /**
     * @param AddPermissionsToRoleRequest $request
     */
    public function execute($request = null)
    {
        $request = $request->getRoleId();
    }
}
