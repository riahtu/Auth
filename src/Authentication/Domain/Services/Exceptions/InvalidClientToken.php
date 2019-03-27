<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 27.03.2019
 * Time: 13:21
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class InvalidClientToken extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'None existed or invalid token!';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
