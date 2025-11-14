<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\BaseModel;
use PDO;

class Page extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Count total countries
     */
    public function countCountries(): int
    {
        $sql = "SELECT COUNT(*) FROM countries";
        $sth = $this->query($sql);
        return (int) $sth->fetchColumn();
    }

    /**
     * Get paginated countries
     */
    public function allCountries(int $start, int $perPage): array
    {
        $sql = "SELECT * FROM countries LIMIT :start, :perPage";
        $sth = $this->prepare($sql);
        $sth->bindParam(':start', $start, PDO::PARAM_INT);
        $sth->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }
}

