<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 25-Feb-19
 * Time: 20:22
 */

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class GeneralDomainServerError extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Something went wrong. Notify someone... or scream for help';
        parent::__construct(JsonResponse::HTTP_INTERNAL_SERVER_ERROR , $return);
    }
}
