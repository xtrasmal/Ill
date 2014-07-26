<?php namespace Ill\Core\CommandBus;

use ReflectionException;

class ValidationCommandBus extends DefaultCommandBus
{

    public function execute($command)
    {
        $this->validate($command);
        return parent::execute($command);
    }

    private function validate($command)
    {

        $validatorClass = $this->inflector->getValidatorClass($command);

        try {
            $validator = $this->container->make($validatorClass);
            $validator->validate($command);

        } catch (ReflectionException $e) {
            return $e->getMessage();

        }
    }
}
