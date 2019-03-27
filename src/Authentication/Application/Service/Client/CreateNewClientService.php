<?php

namespace Authentication\Application\Service\Client;

use Transactional\Interfaces\TransactionalServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Services\Exceptions\NotAllCredentialsSetException;
use Authentication\Domain\Entity\Client;

class CreateNewClientService implements TransactionalServiceInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->clientRepository = $em->getRepository(Client::class);
    }

    /**
     * @param CreateNewClientRequest $request
     *
     * @return array
     * @throws \Exception
     */
    public function execute($request = null): array
    {

        if(!$request->getName() && !$request->getIp()){
            throw new NotAllCredentialsSetException(array('id' => $request->getName() , 'ip' => $request->getIp()));
        }

        $client = new Client(
            $request->getName(),
            $request->getIp()
        );

        $this->clientRepository->add($client);

        return array('token' => $client->getLastActiveAccessToken()->getToken());
    }
}
