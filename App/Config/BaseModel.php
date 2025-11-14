<?php

declare(strict_types=1);

namespace App\Config;

use PDO;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class BaseModel extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8
    }
}

