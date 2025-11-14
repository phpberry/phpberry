<?php

declare(strict_types=1);

namespace App\Hooks;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class ExecutionConfig
{
    public static function init($second = 300)
    {
        ini_set('max_execution_time', (string)($second * 1000));
        ini_set('memory_limit', '-1');
    }
}

