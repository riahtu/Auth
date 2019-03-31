<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 30-Mar-19
 * Time: 19:00
 */

namespace Authentication\Infrastructure\UI\Commands;


use Authentication\Application\Service\Permission\ImportRoutesForPermissionRequest;
use Authentication\Application\Service\Permission\ImportRoutesForPermissionService;
use Authentication\Domain\Entity\Permission;
use Authentication\Domain\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;
use Transactional\Transactional;

class ImportRoutesCommand extends Command
{
    use Transactional;

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ImportRoutesForPermissionService
     */
    private $importService;

    public function __construct(
        RouterInterface $router,
        EntityManagerInterface $em,
        ImportRoutesForPermissionService $importService
    ) {
        $this->router = $router;
        parent::__construct();
        $this->em            = $em;
        $this->importService = $importService;
    }

    protected static $defaultName = 'firewall:import:routs';

    protected function configure()
    {
        $this
            ->setDescription('Import all defined routes!');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $permissionRepository = $this->em->getRepository(Permission::class);
        $roleRepository       = $this->em->getRepository(Role::class);


        /**
         * @var RouteCollection $routeCollection
         */
        $routeCollection = $this->router->getRouteCollection();
        foreach ($routeCollection->all() as $name => $route) {
            $transaction = $this->createTransaction($this->em);
            $resultMessage = $transaction
                ->loadService($this->importService)
                ->executeTransaction(
                    new ImportRoutesForPermissionRequest(
                        $name,
                        $route->getPath()
                    )
                );
            $output->writeln($resultMessage);
        }
    }
}
