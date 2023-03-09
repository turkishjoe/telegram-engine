<?php

namespace Turkishjoe\TelegramEngine;

use Symfony\Component\Routing\RouterInterface;
use Turkishjoe\TelegramEngine\Request\RequestRunner\TelegramRequestRunnerInterface;
use Turkishjoe\TelegramEngine\Request\TelegramRequest;
use Turkishjoe\TelegramEngine\Request\TelegramRequestBuilder;
use Turkishjoe\TelegramEngine\Route\RouteResolverInterface;

class DefaultRequestProcessor
{
    protected UserManager $userManager;
    protected TelegramRequestBuilder $telegramRequestBuilder;
    protected RouterInterface $router;
    protected TelegramRequestRunnerInterface $telegramRequestRunner;
    protected RouteResolverInterface $routeResolver;

    public function process($telegramUpdateData, $botAlias): array{
        $user = $this->userManager->buildTelegramUserObject($telegramUpdateData, $botAlias);
        $telegramRequest = $this->telegramRequestBuilder->build($user, $telegramUpdateData);

        return $this->telegramRequestRunner->call(
            $telegramRequest,
            $this->routeResolver->resolve(
                $telegramRequest
            ),
            []
        );
    }
}
