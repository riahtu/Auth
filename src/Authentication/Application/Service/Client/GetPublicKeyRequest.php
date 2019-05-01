<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 08:42
 */

namespace Authentication\Application\Service\Client;


use Authentication\Domain\Entity\Client\Client;

class GetPublicKeyRequest
{
    /**
     * @var Client
     */
    private $client;
    private $requestIp;

    /**
     * GetPublicKeyRequest constructor.
     *
     * @param Client $client
     * @param $requestIp
     */
    public function __construct(
        Client $client,
        $requestIp
    )
    {
        $this->client = $client;
        $this->requestIp = $requestIp;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getRequestIp()
    {
        return $this->requestIp;
    }
}
