<?php


namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class RoleAlreadyExtendThatRolesException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array = [])
    {
        $return = [
            'error'    => 'Role already extends that role!',
            'resource' => $array,
        ];
        parent::__construct(JsonResponse::HTTP_CONFLICT, $return);
    }
}
