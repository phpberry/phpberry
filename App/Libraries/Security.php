<?php

declare(strict_types=1);

namespace App\Libraries;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class Security
{

    public function script($string)
    {
        //return htmlspecialchars($string);
        return str_replace(array('<', '>', '{', '}', '/', ' ', '$', ':'), array('&lt;', '&gt;', '&#123;', '&#125;', '&#47;', '&nbsp;', '&#36;', '&#58;'), $string);
    }
}

