<?php

declare(strict_types=1);

namespace App\Libraries;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class Json
{
    public function Tojson($input)
    {
        return json_encode($input);
    }

    public function jsonToArray($json)
    {
        return json_decode($json, true);
    }

    public function jsonToObject($json)
    {
        return json_decode($json, false);
    }

    public function objectToArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    public function ArrayToObject($arry)
    {
        return json_decode(json_encode($arry), false);
    }
}

