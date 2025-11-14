<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

// All classes now use Composer PSR-4 autoloading via App\ namespace
// No manual autoloaders needed!
