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

    /**
     * GetPublicKeyRequest constructor.
     *
     * @param Client $client
     */
    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
