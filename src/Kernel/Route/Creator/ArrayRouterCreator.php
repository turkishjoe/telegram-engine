<?php

namespace Turkishjoe\TelegramEngine\Kernel\Route\Creator;

use Turkishjoe\TelegramEngine\Kernel\Route\Action;
use Turkishjoe\TelegramEngine\Kernel\Route\Route;

class ArrayRouterCreator
{
    /**
     * Для обратной совместимости со старыми роутами
     * @var string
     */
    private $defaultAction = 'handle';

    public function create(array $config = []): array{
        $routes = [];

        foreach ($config as $key=>$value){
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
