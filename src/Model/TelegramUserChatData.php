<?php

namespace Turkishjoe\TelegramEngine\Model;

class TelegramUserChatData
{
    private string $chatId;
    private string $username;
    private string $class;

    public function __construct(array $telegramChatData, string $class){
        $this->chatId = $telegramChatData['id'];
        $this->username = $telegramChatData['username'] ?? '';
        $this->class = $class;
    }

    public function getChatId(){
        return $this->chatId;
    }

    public function getUsername(){
        return $this->username;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
