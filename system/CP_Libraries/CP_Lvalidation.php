<?php
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class CP_Lvalidation
{

    public function required($string)
    {
        return empty($string) ? false : true;
    }

    public function alpha($string)
    {
        return ctype_alpha($string) ? true : false;
    }

    public function numeric($string)
    {
        return ctype_digit($string) ? true : false;
    }

    public function alphanumeric($string)
    {
        return ctype_alnum($string) ? true : false;
    }

    public function alpha_space($string)
    {
        return preg_match('/^[\pL\s]+$/u', $string) ? true : false;
    }

    public function email($string)
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function ip($string)
    {
        return filter_var($string, FILTER_VALIDATE_IP) ? true : false;
    }

    public function url($string)
    {
        return filter_var($string, FILTER_VALIDATE_URL) ? true : false;
    }

    public function minlength($string, $min)
    {
        return (strlen($string) >= $min) ? true : false;
    }

    public function maxlength($string, $max)
    {
        return (strlen($string) <= $max) ? true : false;
    }

    public function length_range($string, $min, $max)
    {
        return ((strlen($string) >= $min) and (strlen($string) <= $max)) ? true : false;
    }

    public function equalTo($string1, $string2)
    {
        return (strcmp($string1, $string2) == 0) ? true : false;
    }

}