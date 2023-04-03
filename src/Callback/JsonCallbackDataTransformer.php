<?php

namespace Turkishjoe\TelegramEngine\Callback;

class JsonCallbackDataTransformer implements CallbackDataTransformerInterface
{
    public function serialize(array $data): string
    {
        return json_encode($data);
    }

    public function deserialize(string $data): array
    {
        return json_decode($data, true) ?? [];
    }
}
