<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 14:58
 */

namespace Rest\Infrastructure\UI\Http;


use FOS\RestBundle\Controller\Annotations as Rest;
use Rest\Application\Service\Role\ViewAllRolesService;
use Rest\Application\Service\Role\ViewPermissionsOfRoleRequest;
use Rest\Application\Service\Role\ViewPermissionsOfRoleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RoleController extends TransactionalRestController
{
    /**
     * @Rest\Post("/api/role/permission" , name="add_permission_to_role")
     */
    public function addPermissionToRole()
    {

    }

    /**
     * @Rest\Get("/api/roles" , name="view_all_roles")
     * @param ViewAllRolesService $service
     *
     * @return JsonResponse
     */
    public function viewAllRoles(ViewAllRolesService $service): JsonResponse
    {
        return new JsonResponse($service->execute(), JsonResponse::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/role/permissions" , name="view_permissions_for_role")
     * @param ViewPermissionsOfRoleService $service
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function viewPermissionsForRole(ViewPermissionsOfRoleService $service, Request $request): JsonResponse
    {
        $data = $service->execute(
            new ViewPermissionsOfRoleRequest(
                $request->get('roleDesignation')
            )
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
