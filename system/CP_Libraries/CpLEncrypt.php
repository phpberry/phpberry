<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpLEncrypt
{
    private string $key;

    public function __construct()
    {
        $this->key = md5('₹€ƒ؋л₡₱£¢﷼₪₩₮₦฿₴');
    }

    public function encode($q): string
    {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $q, MCRYPT_MODE_CBC, md5(md5($this->key))));
    }

    public function decode($q): string
    {
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
    }

    public function encode_unique($string): string
    {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        return base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), $string, MCRYPT_MODE_CBC, $iv));
    }

    public function decode_unique($encrypted): string
    {
        $data = base64_decode($encrypted);
        $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, hash('sha256', $this->key, true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv), "\0");
    }

    public function encrypt_url($data): array|string
    {
        for ($i = 0, $key = 27, $c = 48; $i <= 255; $i++) {
            $c = 255 & ($key ^ ($c << 1));
            $table[$key] = $c;
            $key = 255 & $key + 1;
        }
        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            $data[$i] = chr($table[ord($data[$i])]);
        }
        return str_replace('=', '_', base64_encode($data));
    }

    public function decrypt_url($data): array|string
    {
        $data = str_replace('_', '=', base64_decode($data));
        for ($i = 0, $key = 27, $c = 48; $i <= 255; $i++) {
            $c = 255 & ($key ^ ($c << 1));
            $table[$c] = $key;
            $key = 255 & $key + 1;
        }
        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            $data[$i] = chr($table[ord($data[$i])]);
        }
        return $data;
    }
}
