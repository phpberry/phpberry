<?php

declare(strict_types=1);

namespace App\Libraries;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class Extras
{

    public function str2hex($str)
    {
        return array_shift(unpack('H*', $str));
    }

    public function hex2str($hex)
    {
        return pack('H*', $hex);
    }

    public function unique_code($length = 6)
    {
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $charactersLength = count($characters) - 1;
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function getBrowser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

}

