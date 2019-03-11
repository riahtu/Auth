<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 09-Feb-19
 * Time: 9:12
 */

namespace Authentication\Domain\Entity;


interface UserValidationInterface
{
    public function getId();
    public function getUsername();
    public function getEmail();
}
