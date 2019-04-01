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
    private $intendedFor;
    private $subject;

    /**
     * CreateTokenRequest constructor.
     *
     * @param User $user
     * @param $type
     * @param $intendedFor
     * @param $subject
     * @param $requestedData
     */
    public function __construct(
        User $user,
        string $type,
        string $intendedFor,
        string $subject,
        array $requestedData = null

    ) {
        $this->user          = $user;
        $this->type          = $type;
        $this->requestedData = $requestedData;
        $this->intendedFor = $intendedFor;
        $this->subject = $subject;
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
    public function getIntendedFor()
    {
        return $this->intendedFor;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
