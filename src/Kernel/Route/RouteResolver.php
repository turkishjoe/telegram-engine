<?php

namespace Turkishjoe\TelegramEngine\Kernel\Route;

use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequest;
use Turkishjoe\TelegramEngine\Model\TelegramUserInterface;

class RouteResolver
{
    public function resolve(TelegramRequest $telegramRequest, string $defaultAction = '/start'): Route{
        $botMetadata = $telegramRequest->getBot();
        $telegramData = $telegramRequest->getData();
        $routes = $botMetadata->getRoutes();

        /**
         * Команды /help, /start обрабатываем в первую очередь
         */
        if(!empty($telegramData['message']['text']) && !empty($routes[$telegramData['message']['text']])){
            return $routes[$telegramData['message']['text']];
        }

        $text =
            $telegramData['data']['action']
            ?? $state
            ?? $telegramData['message']['text']
            ?? $defaultAction;


        if(empty($telegramData['data']['action']) && empty($state) && $telegramRequest->getUser()->getState() != TelegramUserInterface::DEFAULT){
            $text = $telegramRequest->getUser()->getState();
        }

        if(empty($routes[$text])){
            return $routes[$defaultAction];
        }

        return $routes[$text];
    }
}
