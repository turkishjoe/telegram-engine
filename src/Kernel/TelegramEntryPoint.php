<?php

namespace Turkishjoe\TelegramEngine\Kernel;

use App\Models\Telegram\UpdateInterface;
use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequest;
use Turkishjoe\TelegramEngine\Kernel\Request\TelegramRequestRunner;
use Turkishjoe\TelegramEngine\Kernel\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Kernel\Updates\UpdateObserverInterface;

class TelegramEntryPoint
{
    /**
     * @var UserManagerInterface $userManager
     */
    private UserManagerInterface $userManager;

    /**
     * @var UpdateObserverInterface $updateObserverInterface
     */
    private UpdateObserverInterface $updateObserverInterface;

    /**
     * @var TelegramRequestRunner $telegramRequestRunner
     */
    private $telegramRequestRunner;

    /**
     * @var RouteResolver
     */
    private $routeResolver;

    /**
     * @var Logger $logger
     */
    private $logger;

    public function __construct(
        UserManagerInterface $userManager,
        RouteResolver $routeResolver,
        TelegramRequestRunner $telegramRequestRunner,
        UpdateObserverInterface $updateObserverInterface
    )
    {
        $this->userManager = $userManager;
        $this->routeResolver = $routeResolver;
        $this->telegramRequestRunner = $telegramRequestRunner;
        $this->updateObserverInterface = $updateObserverInterface;
    }

    public function handler($data, BotMetadata $botMetadata){
        $update = $this->updateObserverInterface->initUpdate($data);
        if(empty($update)){
            return [];
        }

        try {
            $telegramRequest = new TelegramRequest();
            $data = empty($data['message']) ? $data['callback_query'] : $data;
            $user = $this->userManager->findOrCreate($data['message']['chat'], $botMetadata->getUserClass());

            if (!empty($data['data'])) {
               $telegramRequest
                    ->setCallbackData(json_decode($data['data'], true) ?? []);
            }

            $text = $data['data']['action'] ?? $data['message']['text'] ?? '/start';

            $telegramRequest->setData($data)
                ->setUser($user)
                ->setCurrentActionText($text)
                ->setBot($botMetadata)
                ->setCallbackData($data['data'] ?? []);

            $route = $this->routeResolver->resolve($telegramRequest);

            $result = $this->telegramRequestRunner->call($telegramRequest, $route, []);
            $this->updateObserverInterface->markUpdateAsProcessed($update);
        }catch (\Throwable $exception){
            if(!is_null($update)){
                $this->updateObserverInterface->markUpdateAsFailed($update);
            }

            throw $exception;
        }

        return $result;
    }
}
