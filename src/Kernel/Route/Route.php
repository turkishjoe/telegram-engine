<?php

namespace Turkishjoe\TelegramEngine\Kernel\Route;

class Route
{
    /**
     * @var string
     */
    private $command;

    /**
     * @var array
     */
    private $middleware = [];

    /**
     * @var Action
     */
    private $action;

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return $this
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * @param array $middleware
     * @return $this
     */
    public function setMiddleware($middleware)
    {
        $this->middleware = $middleware;
        return $this;
    }

    /**
     * @return Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Action $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }
}
