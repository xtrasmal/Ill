<?php namespace Ill\System\Base;

use Ill\Core\CommandBus\DefaultCommandBus;

abstract class AbstractCommandBus
{

    protected $bus;

    public function __construct(DefaultCommandBus $bus)
    {

        $this->bus = $bus;

    }


}
