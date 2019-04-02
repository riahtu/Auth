<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 10:17
 */

namespace Authentication\Infrastructure\UI\Commands;


use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResetRedisCommand extends Command
{
    private $redisServer;

    public function __construct($redisServer)
    {

        parent::__construct();
        $this->redisServer = $redisServer;
    }

    protected static $defaultName = 'cache:redis:reset';

    protected function configure()
    {
        $this
            ->setDescription('Reset Redis');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $redisConnection = RedisAdapter::createConnection($this->redisServer);
        $cache = new RedisAdapter($redisConnection);
        $routes = $cache->getItem('security.routes');
        if (!$routes->isHit()) {
            $routes->set('test Value');
            $cache->save($routes);
            $output->writeln('we is here');
        }
        $output->writeln($routes->get());

    }
}
