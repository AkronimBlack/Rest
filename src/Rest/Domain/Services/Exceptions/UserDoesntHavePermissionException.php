<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Jan-19
 * Time: 9:43
 */

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class UserDoesntHavePermissionException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array)
    {
        $return['error'] = 'User does not have permission!';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_UNAUTHORIZED, $return);
    }
}
