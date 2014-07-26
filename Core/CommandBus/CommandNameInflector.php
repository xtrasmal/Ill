<?php namespace Ill\Core\CommandBus;

class CommandNameInflector
{

    public function getHandlerClass($command)
    {
        return str_replace('Request', 'Handler', get_class($command));
    }

    public function getValidatorClass($command)
    {
        $segments = explode('\\', get_class($command));
        array_splice($segments, -1, false, 'Validators');
        unset($segments[2],$segments[3]);
        return str_replace('Request', 'Validator', implode('\\', $segments));
        //return str_replace('Request', 'Validator', get_class($command));
    }



}
