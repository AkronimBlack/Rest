<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Apr-19
 * Time: 21:34
 */

namespace Rest\Infrastructure\UI\Http;


use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends TransactionalRestController
{
    /**
     * @Rest\Get("/testing" , name="testing")
     */
    public function testing()
    {
        return new JsonResponse(['testing']);
    }
}
