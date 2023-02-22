<?php

namespace Turkishjoe\TelegramEngine\Kernel\Route;

use App\Models\Telegram\BaseTelegramUser;
use Turkishjoe\TelegramEngine\Kernel\BotMetadata;
use Turkishjoe\TelegramEngine\Exception\RouteNotResolvedException;
use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequest;

class RouteResolver
{
    /**
     * @param TelegramRequest $telegramRequest
     * @param string $defaultAction
     * @return Route
     */
    public function resolve(TelegramRequest $telegramRequest, string $defaultAction = '/start'){
        $botMetadata = $telegramRequest->getBot();
        $telegramData = $telegramRequest->getData();
        $state = $telegramRequest->getUser()->getStateData()['action'] ?? null;

        $routes = $botMetadata->getRoutes();

        /**
         * Команды /help, /start обрабатываем в первую очередь
         */
        if(!empty($telegramData['message']['text']) && !empty($routes[$telegramData['message']['text']])){
            $user = $telegramRequest->getUser();
            $user->clearState();
            $user->save();

            return $routes[$telegramData['message']['text']];
        }

        $text =
            $telegramData['data']['action']
            ?? $state
            ?? $telegramData['message']['text']
            ?? $defaultAction;


        if(empty($telegramData['data']['action']) && empty($state) && $telegramRequest->getUser()->getState() != BaseTelegramUser::DEFAULT){
            $text = $telegramRequest->getUser()->getState();
        }

        if(empty($routes[$text])){
            return $routes[$defaultAction];
        }

        return $routes[$text];
    }
}
