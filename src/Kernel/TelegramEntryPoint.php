<?php

namespace Turkishjoe\TelegramEngine\Kernel;

use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequestBuilder;
use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequestRunnerInterface;
use Turkishjoe\TelegramEngine\Kernel\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Kernel\Updates\UpdateObserverInterface;

class TelegramEntryPoint
{
    private UpdateObserverInterface $updateObserverInterface;
    private TelegramRequestRunnerInterface $telegramRequestRunner;
    private TelegramRequestBuilder $telegramRequestBuilder;
    private RouteResolver $routeResolver;

    public function __construct(
        TelegramRequestRunnerInterface $telegramRequestRunner,
        TelegramRequestBuilder $telegramRequestBuilder,
        UpdateObserverInterface $updateObserverInterface,
        RouteResolver $routeResolver
    ) {
        $this->telegramRequestRunner = $telegramRequestRunner;
        $this->updateObserverInterface = $updateObserverInterface;
        $this->telegramRequestBuilder = $telegramRequestBuilder;
        $this->routeResolver = $routeResolver;
    }

    public function handler(array $data, BotMetadata $botMetadata)
    {
        $update = $this->updateObserverInterface->initUpdate($data);
        if (empty($update)) {
            return [];
        }

        try {
            $telegramRequest = $this->telegramRequestBuilder->build($data, $botMetadata);

            $result = $this->telegramRequestRunner->call(
                $telegramRequest,
                $this->routeResolver->resolve($telegramRequest),
                []
            );

            $this->updateObserverInterface->markUpdateAsProcessed($update);
        } catch (\Throwable $exception) {
            if (!is_null($update)) {
                $this->updateObserverInterface->markUpdateAsFailed($update);
            }

            throw $exception;
        }

        return $result;
    }
}
