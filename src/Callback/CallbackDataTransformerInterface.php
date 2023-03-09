<?php

namespace Turkishjoe\TelegramEngine;

/**
 * Пока используется json, но из-за того что callbackData можно только
 * 64 байт, то имеет смысл сделать что-то, что сожмет это
 */
interface CallbackDataTransformerInterface
{
    public function serialize(array $data): string;
    public function deserialize(string $data): array;
}
