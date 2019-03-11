<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 10:36
 */

namespace Authentication\Domain\Services\Exceptions;


interface DomainExceptionInterface
{
    public function __construct(array $array);
}
