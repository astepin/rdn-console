<?php

namespace RdnConsole\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use RdnConsole\Command\CommandInterface;
use Symfony\Component\Console;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class Application implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL)
    {
        $app = new Console\Application;

        $config = $container->get('Config');
        $config = $config['rdn_console'];

        if (isset($config['application']['name']))
        {
            $app->setName($config['application']['name']);
        }
        if (isset($config['application']['version']))
        {
            $app->setVersion($config['application']['version']);
        }

        if (!empty($config['commands']))
        {
            $commands = $container->get('RdnConsole\Command\CommandManager');
            foreach ($config['commands'] as $name)
            {
                /** @var CommandInterface $command */
                $command = $commands->get($name);
                $app->add($command->getAdapter());
            }
        }

        return $app;
    }
}
