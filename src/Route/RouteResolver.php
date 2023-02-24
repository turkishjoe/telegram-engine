<?php

namespace Turkishjoe\TelegramEngine\Route;

use Turkishjoe\TelegramEngine\Model\UserStateData;
use Turkishjoe\TelegramEngine\Request\TelegramRequest;
use Turkishjoe\TelegramEngine\Model\TelegramUser;

class RouteResolver
{
    /**
     * @param TelegramRequest $telegramRequest
     * @param Route[]         $routeConfiguration
     * @param string          $defaultAction
     * @return Route
     */
    public function resolve(TelegramRequest $telegramRequest, array $routeConfiguration, string $defaultAction = '/start'): Route{
        $telegramData = $telegramRequest->getData();

        /**
         * Команды /help, /start обрабатываем в первую очередь
         */
        if(!empty($telegramData['message']['text']) && !empty($routeConfiguration[$telegramData['message']['text']])){
            return $routeConfiguration[$telegramData['message']['text']];
        }

        /**
         * TODO: Make best algoritm for it
         */
        $text =
            $telegramData['data']['action']
            ?? $state
            ?? $telegramData['message']['text']
            ?? $defaultAction;


        $state = $telegramRequest->getUser()->getUserStateData()->getState();
        if(empty($telegramData['data']['action']) && empty($state) && $state !== UserStateData::DEFAULT_STATE){
            $text = $state;
        }

        /**
         * TODO: defaultAction exists
         */
        if(empty($routeConfiguration[$text])){
            return $routeConfiguration[$defaultAction];
        }

        return $routeConfiguration[$text];
    }
}
