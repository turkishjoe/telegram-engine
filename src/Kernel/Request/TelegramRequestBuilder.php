<?php

namespace Turkishjoe\TelegramEngine\Kernel\Request;

use Turkishjoe\TelegramEngine\Kernel\BotMetadata;
use Turkishjoe\TelegramEngine\Kernel\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Kernel\UserManagerInterface;

class TelegramRequestBuilder
{
    /**
     * @var UserManagerInterface $userManager
     */
    private UserManagerInterface $userManager;

    /**
     * @var RouteResolver
     */
    private RouteResolver $routeResolver;


    public function __construct(UserManagerInterface $userManager,  RouteResolver $routeResolver)
    {
        $this->userManager = $userManager;
        $this->routeResolver = $routeResolver;
    }

    public function build(array $telegramData, BotMetadata $botMetadata): TelegramRequest{
        $data = empty($telegramData['message']) ? $telegramData['callback_query'] : $telegramData;
        $user = $this->userManager->get($data['message']['chat'], $botMetadata->getUserClass());

        $callbackData = null;
        if (!empty($data['data'])) {
            $callbackData = json_decode($data['data'], true) ?? [];
        }

        return new TelegramRequest(
            $user,
            $data,
            $callbackData
        );
    }
}
