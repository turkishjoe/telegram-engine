<?php

namespace Turkishjoe\TelegramEngine\Request\RequestRunner;

use Psr\Container\ContainerInterface;
use Turkishjoe\TelegramEngine\Request\TelegramRequest;
use Turkishjoe\TelegramEngine\Route\Route;

class RunnerWithConstructorInjection implements TelegramRequestRunnerInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    /**
     * We have more useful runner(it enables to pass service to method), but it use illuminate/support (laravel)
     * I plan to implement it in another repository. And also make adapater for
     * php-di and symfony container.
     * TODO: middleware
     * TODO: implement more params
     */
    public function call(TelegramRequest $telegramRequest, Route $route, $params = []){
        $action = $route->getAction();
        $controller = $this->container->get($action->getClass());

        return call_user_func([$controller, $action->getMethod()], [$telegramRequest]);
    }
}
