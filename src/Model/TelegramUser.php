<?php

namespace Turkishjoe\TelegramEngine\Model;

class TelegramUser
{
    private TelegramUserChatData $telegramUserData;
    private UserStateData $userStateData;
    private ?string $botAlias;

    public function __construct(UserStateData $userStateData, TelegramUserChatData $telegramUserData, ?string $botAlias){
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
     * @return UserStateData
     */
    public function getUserStateData(): UserStateData
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
