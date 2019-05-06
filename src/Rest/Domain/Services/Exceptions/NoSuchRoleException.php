<?php

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class NoSuchRoleException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return = [
            'error'    => 'No such role exists!',
            'resource' => $array,
        ];
        parent::__construct(JsonResponse::HTTP_NOT_FOUND, $return);
    }
}
