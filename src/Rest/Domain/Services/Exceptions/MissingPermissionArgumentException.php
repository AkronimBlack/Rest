<?php

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class MissingPermissionArgumentException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array = [])
    {
        $return = [
            'error'    => 'Permission missing argument',
            'resource' => $array,
        ];
        parent::__construct(JsonResponse::HTTP_BAD_REQUEST, $return);
    }
}
