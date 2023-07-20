<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpLExtras
{
    public function str2hex(string $str): mixed
    {
        return array_shift(unpack('H*', $str));
    }

    public function hex2str(string $hex): string
    {
        return pack('H*', $hex);
    }

    public function uniqueCode(int $length = 6): string
    {
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $charactersLength = count($characters) - 1;
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getClientIp(): false|array|string
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

    public function getBrowser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}
