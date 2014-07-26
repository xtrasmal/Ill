<?php namespace Ill\Core\CommandBus;

use InvalidArgumentException,
    Illuminate\Container\Container,
    Ill\Core\CommandBus\Interfaces\CommandBusInterface;


class DefaultCommandBus implements CommandBusInterface
{
    protected $container;
    protected $inflector;
    private $decorators;

    public function __construct(Container $container,
                                CommandNameInflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    public function execute($command)
    {
        return $this->getHandler($command)->handle($command);
    }

    private function getHandler($command)
    {
        return $this->container->make($this->inflector->getHandlerClass($command));
    }

    public function decorate($className)
    {
        $this->decorators[] = $className;
    }

    protected function executeDecorators($command)
    {
        foreach ($this->decorators as $className)
        {
            $instance = $this->container->make($className);

            if ( ! $instance instanceof CommandBusInterface)
            {
                $message = 'The class to decorate must be an implementation of Ill\Core\CommandBus\Interfaces\CommandBusInterface';

                throw new InvalidArgumentException($message);
            }

            $instance->execute($command);
        }
    }

}
