<?php


namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class NoSuchPermissionException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Permission with that name does not exist';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_BAD_REQUEST, $return);
    }
}
