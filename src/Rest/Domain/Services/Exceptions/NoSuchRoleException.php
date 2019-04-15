<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 15:37
 */

namespace Rest\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class NoSuchRoleException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'No such role exists!';
        $return['resource'] = $array;
        parent::__construct(Response::HTTP_BAD_REQUEST, $return);
    }
}
