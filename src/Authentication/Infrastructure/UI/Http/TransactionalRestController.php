<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 05-Feb-19
 * Time: 19:38
 */

namespace Authentication\Infrastructure\UI\Http;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Transactional\Transactional;

class TransactionalRestController extends AbstractController
{
    use Transactional;

    protected $transaction;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->transaction = $this->createTransaction($entityManager);
    }

    public function runAsTransaction($service, $request)
    {
        return $this->transaction->loadService($service)->executeTransaction($request);
    }
}
