<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpMDynamic extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
    /*
     * Dynamic Model Start
     */
    /*
     * Dynamic Insert
     ********************************************************************
     * $table = 'helloworld';
     * $fieldValue= array(
     * 'fname' => 'daksh',
     * 'lname' => 'champaneria',
     * 'img'=> 'yeeeee.jpg',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->insert($table,$fieldValue,true);
     */
    /**
     * @param array $fieldValue
     */
    public function insert(string $table, array $fieldValue = [], bool $id = false): bool|string
    {
        $table = '`' . $table . '`';
        $fields = '`' . implode('`,`', array_keys($fieldValue)) . '`';
        $values = ':' . implode(',:', array_keys($fieldValue));
        $sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $values . ')';
        $sth = $this->prepare($sql);
        foreach ($fieldValue as $filed => &$value) {
            $sth->bindParam(":{$filed}", $value);
        }
        if ($id) {
            return $sth->execute() ? $this->lastInsertId() : false;
        }
        return $sth->execute();
    }

    /*
     * Dynamic Update
     ********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $updateField= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * );
     * $whereField= array(
     * 'fname' => 'daksh',
     * 'lname' => 'champaneria',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->update($table,$updateField,$whereField,$con);
     * or
     * $dynamicList=$dynamicHandle->update($table,$updateField);
     */
    /**
     * @param array $updateField
     * @param array $whereField
     */
    public function update(string $table, array $updateField = [], array $whereField = [], string $con = 'AND'): bool
    {
        $table = '`' . $table . '`';
        $fields = '';
        $whereFields = '';
        foreach ($updateField as $filed => $value) {
            $fields .= "`{$filed}`=:{$filed},";
        }
        $fields = substr_replace($fields, '', -1);
        if (! empty($whereField)) {
            $i = 0;
            foreach ($whereField as $filed => $value) {
                $i++;
                $whereFields .= "`{$filed}`=:{$filed}{$i} {$con} ";
            }
            if ($con === 'AND') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -5);
            } elseif ($con === 'OR') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -4);
            }
        }
        $sql = 'UPDATE ' . $table . ' SET ' . $fields . ' ' . $whereFields;
        $sth = $this->prepare($sql);
        foreach ($updateField as $filed => &$value) {
            $sth->bindParam(":{$filed}", $value);
        }
        if (! empty($whereField)) {
            $i = 0;
            foreach ($whereField as $filed => &$value) {
                $i++;
                $sth->bindParam(":{$filed}{$i}", $value);
            }
        }
        return $sth->execute();
    }

    /*
     * Dynamic Delete
     *********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $whereField= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->delete($table,$whereField,$con);
     * or
     * $dynamicList=$dynamicHandle->delete($table);
     */
    /**
     * @param array $whereField
     */
    public function delete(string $table, array $whereField = [], string $con = 'AND'): bool
    {
        $whereFields = '';
        if (! empty($whereField)) {
            foreach ($whereField as $filed => $value) {
                $whereFields .= "`{$filed}`='{$value}' {$con} ";
            }
            if ($con === 'AND') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -5);
            } elseif ($con === 'OR') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -4);
            }
        }
        $sql = 'DELETE FROM ' . $table . ' ' . $whereFields;
        $sth = $this->exec($sql);
        return $sth ? true : false;
    }

    /*
     * Dynamic Select
     ********************************************************************                $table = 'helloworld';
     * $con = 'OR';
     * $fetchField= array(
     * 'fname',
     * 'lname',
     * );
     * $whereField= array(
     * 'fname' => 'Dipesh',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->select($table,$whereField,$fetchField,$con);
     * or
     * $dynamicList=$dynamicHandle->select($table);
     */
    /**
     * @param array $whereField
     * @param array $fetchField
     */
    public function select(string $table, array $whereField = [], array $fetchField = [], string $con = 'AND'): false|array
    {
        $table = '`' . $table . '`';
        $fields = (! empty($fetchField) ? '`' . implode('`,`', $fetchField) . '`' : '*');
        $whereFields = '';
        if (! empty($whereField)) {
            foreach ($whereField as $filed => $value) {
                $whereFields .= "`{$filed}`='{$value}' {$con} ";
            }
            if ($con === 'AND') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -5);
            } elseif ($con === 'OR') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -4);
            }
        }
        $sql = 'SELECT ' . $fields . ' FROM ' . $table . ' ' . $whereFields;
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    /*
     * Dynamic Count
     **********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $whereField= array(
     * 'fname' => 'dipesh',
     * 'lname' => 'sukhia',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->count($table,$whereField,$con);
     * or
     * $dynamicList=$dynamicHandle->count($table);
     */
    /**
     * @param array $whereField
     */
    public function count(string $table, array $whereField = [], string $con = 'AND'): mixed
    {
        $table = '`' . $table . '`';
        $whereFields = '';
        if (! empty($whereField)) {
            foreach ($whereField as $filed => $value) {
                $whereFields .= "`{$filed}`='{$value}' {$con} ";
            }
            if ($con === 'AND') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -5);
            } elseif ($con === 'OR') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -4);
            }
        }
        $sql = 'SELECT COUNT( * ) FROM ' . $table . ' ' . $whereFields;
        $sth = $this->query($sql);
        return $sth->fetchColumn();
    }

    /*
     * Dynamic distinct
     **********************************************************************
     * $table = 'helloworld';
     * $con = 'OR';
     * $fetchField= array(
     * 'fname',
     * 'lname',
     * );
     * $whereField= array(
     * 'fname' => 'Dipesh',
     * 'img' => '54545454545.jpg',
     * );
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->distinct($table,$whereField,$fetchField,$con);
     * or
     * $dynamicList=$dynamicHandle->distinct($table);
     */
    /**
     * @param array $whereField
     * @param array $fetchField
     */
    public function distinct(string $table, array $whereField = [], array $fetchField = [], string $con = 'AND'): false|array
    {
        $table = '`' . $table . '`';
        $fields = (! empty($fetchField) ? '`' . implode('`,`', $fetchField) . '`' : '*');
        $whereFields = '';
        if (! empty($whereField)) {
            foreach ($whereField as $filed => $value) {
                $whereFields .= "`{$filed}`='{$value}' {$con} ";
            }
            if ($con === 'AND') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -5);
            } elseif ($con === 'OR') {
                $whereFields = 'WHERE ' . substr_replace($whereFields, '', -4);
            }
        }
        $sql = 'SELECT DISTINCT ' . $fields . ' FROM ' . $table . ' ' . $whereFields;
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    /*
     * Dynamic Drop Table
     ********************************************************************
     * $table = 'helloworld';
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->deleteTable($table);
     */
    public function deleteTable(string $table): bool
    {
        $table = '`' . $table . '`';
        $sql = 'DROP TABLE ' . $table;
        $sth = $this->exec($sql);
        return (bool) $sth;
    }

    /*
     * Dynamic Truncate Table
     *********************************************************************
     * $table = 'helloworld';
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->emptyTable($table);
     */
    public function emptyTable(string $table): bool
    {
        $table = '`' . $table . '`';
        $sql = 'TRUNCATE TABLE ' . $table;
        $sth = $this->exec($sql);
        return (bool) $sth;
    }

    /*
     * Dynamic Rename Table
     **********************************************************************
     * $table = 'helloworld';
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->renameTable($table,$name);
     */
    public function renameTable(string $table, string $name): bool
    {
        $table = '`' . $table . '`';
        $name = '`' . $name . '`';
        $sql = 'RENAME TABLE ' . $table . ' TO ' . $name;
        $sth = $this->exec($sql);
        return (bool) $sth;
    }

    /*
     * Dynamic INNER JOIN
     *********************************************************************
     * $fetchField = array(
     * 'table1' => array("f11", "f12","f13"),
     * 'table2' => array("f21", "f22","f23"),
     * );
     * $compare = array(
     * 'table1' => "f11",
     * 'table2' => "f21",
     * );
     * $type="IJ";
     * $dynamicHandle=new CpMDynamic();
     * $dynamicList=$dynamicHandle->sqlJoin($fetchField,$compare,$type);
     * var_dump($dynamicList);
     *
     * $type are IJ =INNER JOIN , LOJ = LEFT OUTER JOIN,ROJ = RIGHT OUTER JOIN,FOJ = FULL OUTER JOIN
     */
    /**
     * @param array $fetchField
     * @param array $compare
     */
    public function sqlJoin(array $fetchField = [], array $compare = [], string $type = 'IJ'): false|array
    {
        if (! empty($fetchField)) {
            $fields = '';
            foreach ($fetchField as $table => $tabfiled) {
                $fields .= $table . '.' . implode(", {$table}.", array_values($tabfiled)) . ', ';
            }
            $fields = substr_replace($fields, '', -2);
        } else {
            $fields = '*';
        }
        if ($type === 'IJ') {
            $join = 'INNER JOIN';
        } elseif ($type === 'LOJ') {
            $join = 'LEFT OUTER JOIN';
        } elseif ($type === 'ROJ') {
            $join = 'RIGHT OUTER JOIN';
        } elseif ($type === 'FOJ') {
            $join = 'FULL OUTER JOIN';
        }
        $sql = 'SELECT ' . $fields . ' FROM ' . array_keys($compare)[0] . ' ' . $join . ' ' . array_keys($compare)[1] . ' ON ' . array_keys($compare)[0] . '.' . array_values($compare)[0] . ' = ' . array_keys($compare)[1] . '.' . array_values($compare)[1];
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }
    /*
     * Dynamic Model End
     */
}
