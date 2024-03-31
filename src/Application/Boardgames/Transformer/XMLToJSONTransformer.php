<?php

namespace App\Application\Boardgames\Transformer;

class XMLToJSONTransformer
{
    protected function getValueFromArrayPath(array $data, string $path)
    {
        $keys = explode(".", $path);
        for ($i = 0; $i < count($keys); $i++) {
            if (!array_key_exists($keys[$i], $data)) {
                return null;
            }
            $data = $data[$keys[$i]];
        }
        return $data;
    }
}