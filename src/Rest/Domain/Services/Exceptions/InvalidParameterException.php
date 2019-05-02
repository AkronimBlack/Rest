<?php


namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidParameterException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'One or more parameters is invalid';
        parent::__construct(JsonResponse::HTTP_BAD_REQUEST , $return);
    }
}
