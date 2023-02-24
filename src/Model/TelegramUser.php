<?php

namespace Turkishjoe\TelegramEngine\Model;

class TelegramUser
{
    private TelegramUserChatData $telegramUserData;
    private UserStateData $userStateData;

    public function __construct(UserStateData $userStateData, TelegramUserChatData $telegramUserData){
        $this->userStateData = $userStateData;
        $this->telegramUserData = $telegramUserData;
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
}
