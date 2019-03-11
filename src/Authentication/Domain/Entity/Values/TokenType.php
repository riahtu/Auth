<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 23-Feb-19
 * Time: 14:02
 */

namespace Authentication\Domain\Entity\Values;


class TokenType
{
    public const JWT_TOKEN = 'JWT';
    public const BASIC_TOKEN = 'BASIC';

    public static function getTokenTypes(): array
    {
        return array(
            self::BASIC_TOKEN,
            self::JWT_TOKEN
        );
    }
}
