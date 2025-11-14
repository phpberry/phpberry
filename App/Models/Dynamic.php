<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\BaseModel;
use PDO;

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class Dynamic extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
    /*******************************************************************
     * Dynamic Model Start
     ********************************************************************/
    /*******************************************************************
     * Dynamic Insert
     ********************************************************************
     * $table = 'helloworld';
     * $fieldvalue= array(
     * 'fname' => 'daksh',
     * 'lname' => 'champaneria',
     * 'img'=> 'yeeeee.jpg',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->insert($table,$fieldvalue,true);
     ********************************************************************/
    public function insert($table, $fieldvalue, $id = false)
    {
        $table = "`" . $table . "`";
        $fileds = "`" . implode("`,`", array_keys($fieldvalue)) . "`";
        $values = ":" . implode(",:", array_keys($fieldvalue));
        $sql = "INSERT INTO " . $table . " (" . $fileds . ") VALUES (" . $values . ")";
        $sth = $this->prepare($sql);
        foreach ($fieldvalue as $filed => &$value) {
            $sth->bindParam(":$filed", $value);
        }
        if ($id) {
            return $sth->execute() ? $this->lastInsertId() : false;
        } else {
            return $sth->execute();
        }
    }

    /********************************************************************
     * Dynamic Update
     ********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $updatefield= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * );
     * $wherefield= array(
     * 'fname' => 'daksh',
     * 'lname' => 'champaneria',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->update($table,$updatefield,$wherefield,$con);
     * or
     * $dynamicList=$dynamicHandle->update($table,$updatefield);
     ********************************************************************/
    public function update($table, $updatefield, $wherefield = array(), $con = 'AND')
    {
        $table = "`" . $table . "`";
        $fileds = "";
        $wherefileds = "";
        foreach ($updatefield as $filed => $value) {
            $fileds .= "`$filed`=:$filed,";
        }
        $fileds = substr_replace($fileds, "", -1);
        if (!empty($wherefield)) {
            $i = 0;
            foreach ($wherefield as $filed => $value) {
                $i++;
                $wherefileds .= "`$filed`=:$filed$i $con ";
            }
            if ($con == 'AND') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -5);
            } elseif ($con == 'OR') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -4);
            }
        }
        $sql = "UPDATE " . $table . " SET " . $fileds . " " . $wherefileds;
        $sth = $this->prepare($sql);
        foreach ($updatefield as $filed => &$value) {
            $sth->bindParam(":$filed", $value);
        }
        if (!empty($wherefield)) {
            $i = 0;
            foreach ($wherefield as $filed => &$value) {
                $i++;
                $sth->bindParam(":$filed$i", $value);
            }
        }
        return $sth->execute();
    }

    /********************************************************************
     * Dynamic Delete
     *********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $wherefield= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->delete($table,$wherefield,$con);
     * or
     * $dynamicList=$dynamicHandle->delete($table);
     ********************************************************************/
    public function delete($table, $wherefield = array(), $con = 'AND')
    {
        $wherefileds = "";
        if (!empty($wherefield)) {
            foreach ($wherefield as $filed => $value) {
                $wherefileds .= "`$filed`='$value' $con ";
            }
            if ($con == 'AND') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -5);
            } elseif ($con == 'OR') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -4);
            }
        }
        $sql = "DELETE FROM " . $table . " " . $wherefileds;
        $sth = $this->exec($sql);
        return $sth ? true : false;
    }

    /********************************************************************
     * Dynamic Select
     ********************************************************************                $table = 'helloworld';
     * $con = 'OR';
     * $fatchfield= array(
     * 'fname',
     * 'lname',
     * );
     * $wherefield= array(
     * 'fname' => 'Dipesh',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->select($table,$wherefield,$fatchfield,$con);
     * or
     * $dynamicList=$dynamicHandle->select($table);
     ********************************************************************/
    public function select($table, $wherefield = array(), $fatchfield = array(), $con = 'AND')
    {
        $table = "`" . $table . "`";
        $fileds = (!empty($fatchfield) ? "`" . implode("`,`", $fatchfield) . "`" : "*");
        $wherefileds = "";
        if (!empty($wherefield)) {
            foreach ($wherefield as $filed => $value) {
                $wherefileds .= "`$filed`='$value' $con ";
            }
            if ($con == 'AND') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -5);
            } elseif ($con == 'OR') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -4);
            }
        }
        $sql = "SELECT " . $fileds . " FROM " . $table . " " . $wherefileds;
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    /*********************************************************************
     * Dynamic Count
     **********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $wherefield= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->count($table,$wherefield,$con);
     * or
     * $dynamicList=$dynamicHandle->count($table);
     ********************************************************************/
    public function count($table, $wherefield = array(), $con = 'AND')
    {
        $table = "`" . $table . "`";
        $wherefileds = "";
        if (!empty($wherefield)) {
            foreach ($wherefield as $filed => $value) {
                $wherefileds .= "`$filed`='$value' $con ";
            }
            if ($con == 'AND') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -5);
            } elseif ($con == 'OR') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -4);
            }
        }
        $sql = "SELECT COUNT( * ) FROM " . $table . " " . $wherefileds;
        $sth = $this->query($sql);
        return $sth->fetchColumn();
    }

    /*********************************************************************
     * Dynamic distinct
     **********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $fatchfield= array(
     * 'fname',
     * 'lname',
     * );
     * $wherefield= array(
     * 'fname' => 'Dipesh',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->distinct($table,$wherefield,$fatchfield,$con);
     * or
     * $dynamicList=$dynamicHandle->distinct($table);
     ********************************************************************/
    public function distinct($table, $wherefield = array(), $fatchfield = array(), $con = 'AND')
    {
        $table = "`" . $table . "`";
        $fileds = (!empty($fatchfield) ? "`" . implode("`,`", $fatchfield) . "`" : "*");
        $wherefileds = "";
        if (!empty($wherefield)) {
            foreach ($wherefield as $filed => $value) {
                $wherefileds .= "`$filed`='$value' $con ";
            }
            if ($con == 'AND') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -5);
            } elseif ($con == 'OR') {
                $wherefileds = 'WHERE ' . substr_replace($wherefileds, "", -4);
            }
        }
        $sql = "SELECT DISTINCT " . $fileds . " FROM " . $table . " " . $wherefileds;
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    /********************************************************************
     * Dynamic Drop Table
     ********************************************************************
     * $table = 'helloworld';
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->deletetable($table);
     ********************************************************************/
    public function deletetable($table)
    {
        $table = "`" . $table . "`";
        $sql = "DROP TABLE " . $table;
        $sth = $this->exec($sql);
        return $sth ? true : false;
    }

    /********************************************************************
     * Dynamic Truncate Table
     *********************************************************************                $table = 'helloworld';
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->emptytable($table);
     ********************************************************************/
    public function emptytable($table)
    {
        $table = "`" . $table . "`";
        $sql = "TRUNCATE TABLE " . $table;
        $sth = $this->exec($sql);
        return $sth ? true : false;
    }

    /*********************************************************************
     * Dynamic Rename Table
     **********************************************************************
     * $table = 'helloworld';
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->renametable($table,$name);
     ********************************************************************/
    public function renametable($table, $name)
    {
        $table = "`" . $table . "`";
        $name = "`" . $name . "`";
        $sql = "RENAME TABLE " . $table . " TO " . $name;
        $sth = $this->exec($sql);
        return $sth ? true : false;
    }

    /*********************************************************************
     * Dynamic INNER JOIN
     *********************************************************************
     * $fatchfield = array(
     * 'table1' => array("f11", "f12","f13"),
     * 'table2' => array("f21", "f22","f23"),
     * );
     * $compare = array(
     * 'table1' => "f11",
     * 'table2' => "f21",
     * );
     * $type="IJ";
     * $dynamicHandle=new Dynamic();
     * $dynamicList=$dynamicHandle->sqljoin($fatchfield,$compare,$type);
     * var_dump($dynamicList);
     *
     * $type are IJ =INNER JOIN , LOJ = LEFT OUTER JOIN,ROJ = RIGHT OUTER JOIN,FOJ = FULL OUTER JOIN
     ********************************************************************/
    public function sqljoin($fatchfield = array(), $compare, $type = "IJ")
    {
        if (!empty($fatchfield)) {
            $fileds = "";
            foreach ($fatchfield as $table => $tabfiled) {
                $fileds .= $table . "." . implode(", $table.", array_values($tabfiled)) . ", ";
            }
            $fileds = substr_replace($fileds, "", -2);
        } else {
            $fileds = '*';
        }
        if ($type == "IJ") {
            $join = "INNER JOIN";
        } elseif ($type == "LOJ") {
            $join = "LEFT OUTER JOIN";
        } elseif ($type == "ROJ") {
            $join = "RIGHT OUTER JOIN";
        } elseif ($type == "FOJ") {
            $join = "FULL OUTER JOIN";
        }
        $sql = "SELECT " . $fileds . " FROM " . array_keys($compare)[0] . " " . $join . " " . array_keys($compare)[1] . " ON " . array_keys($compare)[0] . "." . array_values($compare)[0] . " = " . array_keys($compare)[1] . "." . array_values($compare)[1];
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }
    /*********************************************************************
     * Dynamic Model End
     *********************************************************************/
}
