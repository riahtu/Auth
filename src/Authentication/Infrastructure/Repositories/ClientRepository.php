<?php
namespace Authentication\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;
use Authentication\Domain\Entity\Client;

class ClientRepository extends EntityRepository
{
    public function add(Client $client)
    {
        $this->getEntityManager()->persist($client);
    }
}
