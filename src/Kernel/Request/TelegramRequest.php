<?php

namespace Turkishjoe\TelegramEngine\Kernel\Request;

use Turkishjoe\TelegramEngine\Exception\TelegramMessageTypeException;
use Turkishjoe\TelegramEngine\Kernel\BotMetadata;
use Turkishjoe\TelegramEngine\Model\TelegramMessageType;
use Turkishjoe\TelegramEngine\Model\TelegramUserInterface;

class TelegramRequest
{
    const TELEGRAM_TYPES_MAPPING = [
        'voice'=>TelegramMessageType::VOICE_TYPE,
        'text'=>TelegramMessageType::TEXT_TYPE,
        'photo'=>TelegramMessageType::PHOTO_TYPE,
    ];

    private array $callbackData;
    private string $currentActionText;
    private TelegramUserInterface $user;
    private array $data;
    private BotMetadata $bot;

    public function getCallbackData(): array
    {
        return $this->callbackData;
    }

    public function setCallbackData(array $callbackData): self
    {
        $this->callbackData = $callbackData;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->data['message']['text'] ?? '';
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
            if(array_key_exists($telegramKey,$this->data['message']))
            {
                return $telegramMessageType;
            }
        }

        throw new TelegramMessageTypeException();
    }


    public function getUser(): TelegramUserInterface
    {
        return $this->user;
    }

    public function setUser(TelegramUserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getBot()
    {
        return $this->bot;
    }

    public function setBot(BotMetadata $bot)
    {
        $this->bot = $bot;

        return $this;
    }

    public function getCurrentActionText(): string
    {
        return $this->currentActionText;
    }

    /**
     * @param string $currentActionText
     *
     * @return $this
     */
    public function setCurrentActionText(string $currentActionText): self
    {
        $this->currentActionText = $currentActionText;

        return $this;
    }
}
