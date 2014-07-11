<?php namespace Ill\Core\CommandBus\Interfaces;

interface CommandBusInterface
{

    public function execute($command);
    
}
