<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpLJson
{
    public function toJson(mixed $input): false|string
    {
        return json_encode($input);
    }

    /**
     * @param $json
     */
    public function jsonToArray($json): mixed
    {
        return json_decode($json, true);
    }

    /**
     * @param $json
     */
    public function jsonToObject($json): mixed
    {
        return json_decode($json, false);
    }

    /**
     * @param $object
     */
    public function objectToArray($object): mixed
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * @param array $array
     */
    public function arrayToObject(array $array): mixed
    {
        return json_decode(json_encode($array), false);
    }
}
