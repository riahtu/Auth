<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 19-Feb-19
 * Time: 17:45
 */

namespace Authentication\Application\Service\Token;


use Authentication\Domain\Entity\User\User;

class CreateTokenRequest
{
    /**
     * @var User
     */
    private $user;
    private $type;
    private $requestedData;
    private $audience;
    private $subject;

    /**
     * CreateTokenRequest constructor.
     *
     * @param User $user
     * @param $type
     * @param $audience
     * @param $subject
     * @param $requestedData
     */
    public function __construct(
        User $user,
        $audience = null,
        $type = null,
        $subject = null,
        array $requestedData = null

    ) {
        $this->user          = $user;
        $this->type          = $type;
        $this->requestedData = $requestedData;
        $this->audience   = $audience;
        $this->subject       = $subject;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getRequestedData()
    {
        return $this->requestedData;
    }

    /**
     * @return mixed
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
