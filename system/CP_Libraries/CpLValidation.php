<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpLValidation
{
    public function required(string $string): bool
    {
        return ! empty($string);
    }

    public function alpha(string $string): bool
    {
        return ctype_alpha($string);
    }

    public function numeric(string $string): bool
    {
        return ctype_digit($string);
    }

    public function alphanumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    public function alphaSpace(string $string): bool
    {
        return (bool) preg_match('/^[\pL\s]+$/u', $string);
    }

    public function email(string $string): bool
    {
        return (bool) filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    public function ip(string $string): bool
    {
        return (bool) filter_var($string, FILTER_VALIDATE_IP);
    }

    public function url(string $string): bool
    {
        return (bool) filter_var($string, FILTER_VALIDATE_URL);
    }

    public function minlength(string $string, int $min): bool
    {
        return strlen($string) >= $min;
    }

    public function maxlength(string $string, int $max): bool
    {
        return strlen($string) <= $max;
    }

    public function lengthRange(string $string, int $min, int $max): bool
    {
        return (strlen($string) >= $min) and (strlen($string) <= $max);
    }

    public function equalTo(string $string1, string $string2): bool
    {
        return strcmp($string1, $string2) === 0;
    }
}
