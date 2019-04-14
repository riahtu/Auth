<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 19-Dec-18
 * Time: 20:17
 */

namespace Authentication\Domain\Services\EventListeners;

use Authentication\Domain\Services\Exceptions\UserDoesntHavePermissionException;
use Authentication\Domain\Services\Permission\CheckForPermissionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Transactional\Transactional;

class RequestListener implements EventSubscriberInterface
{
    use Transactional;
    /**
     * @var TokenStorageInterface
     */
    private $securityStorage;
    /**
     * @var CheckForPermissionService
     */
    private $checkForPermissionService;

    public function __construct(
        TokenStorageInterface $securityStorage,
        CheckForPermissionService $checkForPermissionService
    ) {
        $this->securityStorage           = $securityStorage;
        $this->checkForPermissionService = $checkForPermissionService;
    }

    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::REQUEST => array(
                ['checkForPermission', 0],
            ),
        );
    }

    public function checkForPermission(GetResponseEvent $event): void
    {
        if(!$this->securityStorage->getToken()){
            throw new UserDoesntHavePermissionException(['user' => 'Anon']);
        }
        $user = $this->securityStorage->getToken()->getUser();
        $this->checkForPermissionService->execute(
            $user,
            $event->getRequest()->getPathInfo()
        );
    }
}
