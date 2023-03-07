<?php

namespace Turkishjoe\TelegramEngine\Request;

use Turkishjoe\TelegramEngine\Exception\TelegramMessageTypeException;
use Turkishjoe\TelegramEngine\Model\TelegramMessageType;
use Turkishjoe\TelegramEngine\Model\TelegramUser;

class TelegramRequest
{
    const TELEGRAM_TYPES_MAPPING = [
        'voice'=>TelegramMessageType::VOICE_TYPE,
        'text'=>TelegramMessageType::TEXT_TYPE,
        'photo'=>TelegramMessageType::PHOTO_TYPE,
    ];

    private ?array $callbackData;
    private TelegramUser $user;
    private array $messageData;

    /**
     * TODO: message data to object
     * @param TelegramUser $user
     * @param array        $messageData
     * @param array|null   $callbackData
     */
    public function __construct(
        TelegramUser $user,
        array $messageData,
        ?array $callbackData
    ){
        $this->user = $user;
        $this->messageData = $messageData;
        $this->callbackData = $callbackData;
    }

    public function getCallbackData(): array
    {
        return $this->callbackData;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->messageData['message']['text'] ?? '';
    }

    /**
     * TODO: support all types
     * TODO: 8.1 return TelegramMessageType
     *
     * @return string
     */
    public function getType(): string
    {
        foreach (self::TELEGRAM_TYPES_MAPPING as $telegramKey => $telegramMessageType){
            if(array_key_exists($telegramKey,$this->messageData['message']))
            {
                return $telegramMessageType;
            }
        }

        throw new TelegramMessageTypeException();
    }


    public function getUser(): TelegramUser
    {
        return $this->user;
    }
    
    public function getChatId(): string{
        return $this->getUser()
            ->getTelegramUserData()
            ->getChatId();
    }

    public function getData(): array
    {
        return $this->messageData;
    }
}
