<?php namespace Ill\Core\Events\Interfaces;

interface ListenerInterface
{

    public function handle(EventInterface $event);

}
