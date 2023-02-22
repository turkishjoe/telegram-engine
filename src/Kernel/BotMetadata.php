<?php

namespace Turkishjoe\TelegramEngine\Kernel;

use TelegramBot\Api\BotApi;

class BotMetadata
{
    /**
     * @var BotApi
     */
    private $botService;

    /**
     * @var string
     */
    private $userClass;

    /**
     * @var string
     */
    private $botAlias;

    /**
     * @var array
     */
    private $middleware = [];

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @deprecated
     * @return BotApi
     */
    public function getBotService()
    {
        return $this->botService;
    }

    /**
     * @deprecated
     * @param BotApi $botService
     * @return $this
     */
    public function setBotService($botService)
    {
        $this->botService = $botService;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserClass()
    {
        return $this->userClass;
    }

    /**
     * @param string $userClass
     * @return $this
     */
    public function setUserClass($userClass)
    {
        $this->userClass = $userClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getBotAlias()
    {
        return $this->botAlias;
    }

    /**
     * @param string $botAlias
     * @return $this
     */
    public function setBotAlias($botAlias)
    {
        $this->botAlias = $botAlias;
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
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     * @return $this
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }
}
