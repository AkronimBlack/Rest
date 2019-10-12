<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Apr-19
 * Time: 21:34
 */

namespace Rest\Infrastructure\UI\Http;


use FOS\RestBundle\Controller\Annotations as Rest;
use Rest\Application\Service\User\ViewUserSettingsRequest;
use Rest\Application\Service\User\ViewUserSettingsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Transactional\TransactionalRestController;

class UserController extends TransactionalRestController
{
    /**
     * @Rest\Get("/api/user/settings" , name="get_user_settings")
     * @param Request $request
     *
     * @param ViewUserSettingsService $service
     *
     * @return JsonResponse
     */
    public function getUserSettings(Request $request, ViewUserSettingsService $service): JsonResponse
    {
        $response = $this->runAsTransaction(
            $service,
            new ViewUserSettingsRequest(
                $this->getUser(),
                    $request->get('appId')
            )
        );
        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }

//    /**
//     * @Rest\Put("/api/user/role" , name="assign_user_role")
//     * @param AssignRoleToUserService $service
//     * @param Request $request
//     *
//     * @return JsonResponse
//     */
//    public function assignRole(AssignRoleToUserService $service , Request $request): JsonResponse
//    {
//        $response = $this->runAsTransaction(
//            $service,
//            new AssignRoleToUserRequest()
//        );
//        return new JsonResponse($response, JsonResponse::HTTP_OK);
//    }
}
