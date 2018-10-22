<?php

use Phalcon\Cli\Task;

class GenerateTask extends Task
{
    const NAME_PATTERN = '~^[a-z](-?[a-z0-9]+)+$~';
    private $_modulesDir;

    public function initialize()
    {
        $this->_modulesDir = realpath(__DIR__ . '/../../modules');
    }

    public function mAction(array $params)
    {
        $this->moduleAction($params);
    }

    public function cAction(array $params)
    {
        $this->controllerAction($params);
    }

    public function dAction(array $params)
    {
        $this->modelAction($params);
    }

    public function moduleAction(array $params)
    {
        if (count($params) !== 1 || !preg_match(self::NAME_PATTERN, $params[0])) {
            throw new \InvalidArgumentException('Module name must follow regex ' . self::NAME_PATTERN);
        }
        $moduleName = $params[0];
        mkdir($this->_modulesDir . '/' . $moduleName);
        mkdir($this->_modulesDir . '/' . $moduleName . '/controllers');
        mkdir($this->_modulesDir . '/' . $moduleName . '/models');
    }

    public function controllerAction(array $params)
    {
        if (count($params) === 1) {
            $params = explode('/', $params[0]);
        }
        if (count($params) !== 2 || !preg_match(self::NAME_PATTERN, $params[0])
            || !preg_match(self::NAME_PATTERN, $params[1])) {
            throw new \InvalidArgumentException('Module and Controller names must follow regex '
                . self::NAME_PATTERN);
        }
    }

    public function modelAction(array $params)
    {
        if (count($params) === 1) {
            $params = explode('/', $params[0]);
        }
        if (count($params) !== 2 || !preg_match(self::NAME_PATTERN, $params[0])
            || !preg_match(self::NAME_PATTERN, $params[1])) {
            throw new \InvalidArgumentException('Module and Model names must follow regex '
                . self::NAME_PATTERN);
        }

    }
}
