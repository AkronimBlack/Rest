<?php


namespace Rest\Infrastructure\UI\Http;

use FOS\RestBundle\Controller\Annotations as Rest;
use Rest\Application\Service\Permission\ViewAllPermissionsRequest;
use Rest\Application\Service\Permission\ViewAllPermissionsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Transactional\TransactionalRestController;

class PermissionController extends TransactionalRestController
{
    /**
     * @Rest\Get("/api/permissions" , name="view_all_permissions")
     * @param ViewAllPermissionsService $service
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function viewAllPermissions(ViewAllPermissionsService $service , Request $request): JsonResponse
    {
        $data = $service->execute(
            new ViewAllPermissionsRequest(
                $request->get('roleId')
            )
        );
        return new JsonResponse($data , JsonResponse::HTTP_OK);
    }
}
