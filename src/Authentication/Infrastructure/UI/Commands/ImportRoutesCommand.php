<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 30-Mar-19
 * Time: 19:00
 */

namespace Authentication\Infrastructure\UI\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class ImportRoutesCommand extends Command
{

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        parent::__construct();
    }

    protected static $defaultName = 'firewall:import:routs';

    protected function configure()
    {
        $this
            ->setDescription('Import all defined routes!');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var RouteCollection $routeCollection
         */
        $routeCollection = $this->router->getRouteCollection();
        foreach ($routeCollection as $route) {
            $output->writeLn($route->getPath());
        }
    }
}
