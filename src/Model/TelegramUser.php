<?php

namespace Turkishjoe\TelegramEngine\Model;

class TelegramUser
{
    private TelegramUserChatData $telegramUserData;
    private UserStorageDataInterface $userStateData;
    private ?string $botAlias;

    public function __construct(UserStorageDataInterface $userStateData, TelegramUserChatData $telegramUserData, ?string $botAlias){
        $this->userStateData = $userStateData;
        $this->telegramUserData = $telegramUserData;
        $this->botAlias = $botAlias;
    }

    /**
     * @return TelegramUserChatData
     */
    public function getTelegramUserData(): TelegramUserChatData
    {
        return $this->telegramUserData;
    }

    /**
     * @return UserStorageDataInterface
     */
    public function getUserStateData(): UserStorageDataInterface
    {
        return $this->userStateData;
    }

    /**
     * @return string|null
     */
    public function getBotAlias(): ?string
    {
        return $this->botAlias;
    }
}
