<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 13:08
 */

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidTokenException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Invalid authentication token!';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_UNAUTHORIZED, $return);
    }
}
