<?php

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidTokenException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return = [
            'error'    => 'Invalid authentication token!',
            'resource' => $array,
        ];
        parent::__construct(JsonResponse::HTTP_UNAUTHORIZED, $return);
    }
}
