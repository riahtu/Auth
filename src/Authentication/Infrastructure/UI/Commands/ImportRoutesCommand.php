<?php

namespace Authentication\Infrastructure\UI\Commands;


use Authentication\Application\Service\Permission\ImportRoutesForPermissionRequest;
use Authentication\Application\Service\Permission\ImportRoutesForPermissionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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

    protected static $defaultName = 'security:import:routes';

    protected function configure()
    {
        $this
            ->setDescription('Import all defined routes!')
            ->addOption('clean' , null , InputOption::VALUE_NONE , 'Remove routes in DB that are no longer used in any controller')
            ->addOption('update' , null , InputOption::VALUE_NONE , 'Just update routes in DB')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var RouteCollection $routeCollection
         */
        $routeCollection = $this->router->getRouteCollection();
        $transaction     = $this->createTransaction($this->em);
        $resultMessage   = $transaction
            ->loadService($this->importService)
            ->executeTransaction(
                new ImportRoutesForPermissionRequest(
                    $routeCollection,
                    $input->getOption('clean'),
                    $input->getOption('update')
                )
            );
        foreach ($resultMessage as $msg){
            $output->writeln($msg);
        }
    }
}
