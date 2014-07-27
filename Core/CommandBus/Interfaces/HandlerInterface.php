<?php namespace Ill\Core\CommandBus\Interfaces;

interface HandlerInterface
{

    public function handle($request);
    public function dispatch($entity);
    public function respond($response);

}
