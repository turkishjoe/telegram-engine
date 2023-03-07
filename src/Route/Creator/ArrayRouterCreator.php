<?php

namespace Turkishjoe\TelegramEngine\Route\Creator;

use Turkishjoe\TelegramEngine\Route\Action;
use Turkishjoe\TelegramEngine\Route\Route;

/**
 * Утлита для RouteResolver
 */
class ArrayRouterCreator
{
    /**
     * Для обратной совместимости со старыми роутами
     * @var string
     */
    private $defaultAction = 'handle';

    private array $routeConfig;

    public function __construct(array $config = []){
        $this->routeConfig = $config;
    }

    /**
     * @return Action[]
     */
    public function create(): array{
        $routes = [];

        foreach ($this->routeConfig as $key=>$value){
            $route = new Route();
            $action = new Action();

            if(is_array($value)) {
                $action->setClass($value[0]);
                $action->setMethod($value[1] ?? $this->defaultAction);
                $route->setMiddleware($value[2] ?? []);
            }else if(is_string($value)){
                $action->setClass($value);
                $action->setMethod($this->defaultAction);
            }else{
                throw new \InvalidArgumentException("Invalid config " . $value);
            }

            $route->setCommand($key);
            $route->setAction($action);

            $routes[$key] = $route;
        }

        return $routes;
    }
}
