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
    public function getUserSettings(Request $request , ViewUserSettingsService $service): JsonResponse
    {
        $resposne = $service->execute(
            new ViewUserSettingsRequest(
                $this->getUser(),
                'placeholder'
            )
        );

        return new JsonResponse($resposne , JsonResponse::HTTP_OK);
    }
}
