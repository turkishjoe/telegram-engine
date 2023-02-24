<?php

namespace Turkishjoe\TelegramEngine;

use Turkishjoe\TelegramEngine\Request\TelegramRequestBuilder;
use Turkishjoe\TelegramEngine\Request\TelegramRequestRunnerInterface;
use Turkishjoe\TelegramEngine\Route\Creator\RouteCollectionCreator;
use Turkishjoe\TelegramEngine\Route\RouteResolver;
use Turkishjoe\TelegramEngine\Storage\UpdateStorageInterface;
use Turkishjoe\TelegramEngine\Model\Update;

class TelegramRunner
{
    private UpdateStorageInterface $updateStorageInterface;
    private TelegramRequestRunnerInterface $telegramRequestRunner;
    private TelegramRequestBuilder $telegramRequestBuilder;
    private RouteResolver $routeResolver;
    private UserManager $userManager;
    private RouteCollectionCreator $routeCollectionCreator;

    public function __construct(
        TelegramRequestRunnerInterface $telegramRequestRunner,
        TelegramRequestBuilder $telegramRequestBuilder,
        UpdateStorageInterface $updateStorageInterface,
        RouteResolver $routeResolver,
        RouteCollectionCreator $routeCollectionCreator,
        UserManager $userManager
    ) {
        $this->telegramRequestRunner = $telegramRequestRunner;
        $this->updateStorageInterface = $updateStorageInterface;
        $this->telegramRequestBuilder = $telegramRequestBuilder;
        $this->routeResolver = $routeResolver;
        $this->userManager = $userManager;
        $this->routeCollectionCreator = $routeCollectionCreator;
    }

    /**
     * TODO: validate telegram request
     *
     * @param array       $telegramUpdateData
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function handler(array $telegramUpdateData)
    {
        $update = new Update((string)$telegramUpdateData['update_id']);

        /**
         * TODO: Change to event/subscribe
         */
        $update->makeProcessing();
        $this->updateStorageInterface->saveState($update);


        try {
            $user = $this->userManager->buildTelegramUserObject($telegramUpdateData);
            $telegramRequest = $this->telegramRequestBuilder->build($user, $telegramUpdateData);

            $result = $this->telegramRequestRunner->call(
                $telegramRequest,
                $this->routeResolver->resolve(
                    $telegramRequest,
                    $this->routeCollectionCreator->create()
                ),
                []
            );

            /**
             * TODO: Change to event/subscribe
             */
            $update->makeSuccess();
            $this->updateStorageInterface->saveState($update);
        } catch (\Throwable $exception) {
            if (!is_null($update)) {
                /**
                 * TODO: Change to event/subscribe
                 */
                $update->makeFailed();
                $this->updateStorageInterface->saveState($update);
            }

            throw $exception;
        }

        return $result;
    }
}
