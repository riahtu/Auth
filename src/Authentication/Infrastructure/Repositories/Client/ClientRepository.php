<?php
namespace Authentication\Infrastructure\Repositories\Client;


use Doctrine\ORM\EntityRepository;
use Authentication\Domain\Entity\Client\Client;

class ClientRepository extends EntityRepository
{
    public function add(Client $client)
    {
        $this->getEntityManager()->persist($client);
    }
}
