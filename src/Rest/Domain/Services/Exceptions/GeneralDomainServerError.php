<?php

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class GeneralDomainServerError extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array = [])
    {
        $return = [
            'error'    => 'Something went wrong. Notify someone... or scream for help',
            'resource' => $array,
        ];
        parent::__construct(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $return);
    }
}
