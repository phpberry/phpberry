<?php

declare(strict_types=1);

class MY_Mpage extends base_model
{

    public function __construct()
    {
        parent::__construct();
    }
    /* ============================================================================================ */
    /* ================================== profile-Start ======================================= */
    /* ============================================================================================ */

    public function countCountries()
    {

        $sql = "SELECT count(*) FROM countries";
        $sth = $this->query($sql);

        return $sth->fetchColumn();
    }

    public function allCountries($start, $per_page)
    {
        $sql = "SELECT * FROM countries LIMIT $start , $per_page";
        echo $sql;
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }


    /* ============================================================================================ */
    /* ================================== profile-Close ======================================= */
    /* ============================================================================================ */
}

?>