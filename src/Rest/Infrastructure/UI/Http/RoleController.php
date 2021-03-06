<?php

namespace Rest\Infrastructure\UI\Http;


use FOS\RestBundle\Controller\Annotations as Rest;
use Rest\Application\Service\Role\AddPermissionsToRoleRequest;
use Rest\Application\Service\Role\AddPermissionsToRoleService;
use Rest\Application\Service\Role\CreateNewRoleRequest;
use Rest\Application\Service\Role\CreateNewRoleService;
use Rest\Application\Service\Role\DeleteRoleRequest;
use Rest\Application\Service\Role\DeleteRoleService;
use Rest\Application\Service\Role\EditRoleRequest;
use Rest\Application\Service\Role\EditRoleService;
use Rest\Application\Service\Role\ExtendRoleRequest;
use Rest\Application\Service\Role\ExtendRoleService;
use Rest\Application\Service\Role\ViewAllRolesService;
use Rest\Application\Service\Role\ViewExtendedRolesForRoleRequest;
use Rest\Application\Service\Role\ViewExtendedRolesForRoleService;
use Rest\Application\Service\Role\ViewPermissionsOfRoleRequest;
use Rest\Application\Service\Role\ViewPermissionsOfRoleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Transactional\TransactionalRestController;

class RoleController extends TransactionalRestController
{
    /**
     * @Rest\Post("/api/role" , name="create_role")
     * @param Request $request
     *
     * @param CreateNewRoleService $service
     *
     * @return JsonResponse
     */
    public function createNewRole(Request $request, CreateNewRoleService $service): JsonResponse
    {
        $data = $this->runAsTransaction(
            $service,
            new CreateNewRoleRequest(
                $request->get('name'),
                $request->get('designation')
            )
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/role" , name="delete_role")
     * @param Request $request
     *
     *
     * @param DeleteRoleService $service
     *
     * @return JsonResponse
     */
    public function deleteRole(Request $request, DeleteRoleService $service): JsonResponse
    {
        $data = $this->runAsTransaction(
            $service,
            new DeleteRoleRequest(
                $request->get('id')
            )
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @Rest\Put("/api/role" , name="edit_role")
     * @param Request $request
     *
     *
     * @param EditRoleService $service
     *
     * @return JsonResponse
     */
    public function editRole(Request $request, EditRoleService $service): JsonResponse
    {
        $data = $this->runAsTransaction(
            $service,
            new EditRoleRequest(
                $request->get('id'),
                $request->get('name'),
                $request->get('designation')
            )
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK);
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

    /**
     * @Rest\Post("/api/role/permission" , name="add_permission_to_role")
     * @param AddPermissionsToRoleService $service
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function addPermissionsToRole(AddPermissionsToRoleService $service, Request $request): JsonResponse
    {
        $data = $this->runAsTransaction(
            $service,
            new AddPermissionsToRoleRequest(
                $request->get('roleId'),
                $request->get('permissions')
            )
        );

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @Rest\Put("/api/role/extend" , name="extend_role")
     * @param Request $request
     * @param ExtendRoleService $service
     *
     * @return JsonResponse
     */
    public function extendRole(Request $request, ExtendRoleService $service): JsonResponse
    {
        $data = $this->runAsTransaction(
            $service,
            new ExtendRoleRequest(
                $request->get('roleToExtend'),
                $request->get('rolesBeingExtended')
            )
        );
        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/role/extend" , name="view_extended_roles")
     * @param Request $request
     * @param ViewExtendedRolesForRoleService $service
     *
     * @return JsonResponse
     */
    public function getExtendRoles(Request $request, ViewExtendedRolesForRoleService $service): JsonResponse
    {
        $data = $service->execute(
            new ViewExtendedRolesForRoleRequest(
                $request->get('roleDesignation')
            )
        );
        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
