<?php

namespace Turkishjoe\TelegramEngine\Kernel\Request;

use App\Service\ReflectionUtils\ContainerDependencyResolver;
use Turkishjoe\TelegramEngine\Kernel\BotMetadata;
use Turkishjoe\TelegramEngine\Kernel\ResponseResolver;
use Turkishjoe\TelegramEngine\Kernel\Route\Action;
use Turkishjoe\TelegramEngine\Kernel\Route\Route;
use Illuminate\Container\Container;
use Illuminate\Routing\Pipeline;

/**
 * Class TelegramRouteResolver
 * @package App\Service\Telegram\Kernel
 */
class TelegramRequestRunner
{
    /**
     * @var ContainerDependencyResolver
     */
    protected $containerDependencyResolver;

    /**
     * @var Container $container
     */
    protected $container;

    public function __construct(ContainerDependencyResolver $containerDependencyResolver, Container $container)
    {
        $this->containerDependencyResolver = $containerDependencyResolver;
        $this->container = $container;
    }

    public function call(TelegramRequest $telegramRequest, Route $route, $params = []){
        $middleware = $this->getRouteMiddleware($telegramRequest->getBot(), $route);

        return (new Pipeline($this->container))
            ->send($telegramRequest)
            ->through($middleware)
            ->then(function ($request) use ($route, $params) {
                $action = $route->getAction();
                $this->runAction($action, array_merge([$request, $params]));

                return 0;
            });
    }

    protected function runAction(Action $action, $params){
        return $this->containerDependencyResolver->runClassMethod(
            $this->container->make($action->getClass()), $action->getMethod(), $params
        );
    }

    /**
     * TODO: Оптимизировать
     *
     * @param BotMetadata $botMetadata
     * @param Route $route
     * @return array
     */
    protected function getRouteMiddleware(BotMetadata $botMetadata, Route $route){
        $botMetadataMiddleware = $botMetadata->getMiddleware();
        $routeMetadataMiddleware = $route->getMiddleware();

        ksort($botMetadataMiddleware);
        ksort($routeMetadataMiddleware);

        $priorities = array_merge(array_keys($botMetadataMiddleware), array_keys($routeMetadataMiddleware));
        $result = [];

        foreach ($priorities as $priority){
            if(!empty($botMetadataMiddleware[$priority]) && !empty($routeMetadataMiddleware[$priority])){
                $result[$priority] = $routeMetadataMiddleware[$priority];
                $result[$priority] = $botMetadataMiddleware[$priority];
            }else if(!empty($botMetadataMiddleware[$priority])){
                $result[$priority] = $botMetadataMiddleware[$priority];
            }else{
                $result[$priority] = $routeMetadataMiddleware[$priority];
            }
        }

        return array_merge($botMetadata->getMiddleware(), $route->getMiddleware());
    }
}
