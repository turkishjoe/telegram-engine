<?php

namespace Turkishjoe\TelegramEngine\Kernel;

class BotMetadata
{
    private $botService;
    private string $userClass;
    private string $botAlias;
    private array $middleware = [];
    private array $routes = [];

    public function __construct(
        $userClass,
        $botAlias,
        $botService,
        $routes = [],
        $middleware = []
    ){

    }

    /**
     * @deprecated
     * @return BotApi
     */
    public function getBotService()
    {
        return $this->botService;
    }

    /**
     * @return string
     */
    public function getUserClass()
    {
        return $this->userClass;
    }


    /**
     * @return string
     */
    public function getBotAlias()
    {
        return $this->botAlias;
    }


    /**
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
