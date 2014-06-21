<?php namespace Ill\Core\CommandBus\Interfaces;

interface HandlerInterface
{
    public function handle($request);
}
