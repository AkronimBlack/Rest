<?php

namespace Rest\Domain\Services\Exceptions;


interface DomainExceptionInterface
{
    public function __construct(array $array = []);
}
