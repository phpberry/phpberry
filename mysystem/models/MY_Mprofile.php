<?php

class MY_Mprofile extends base_model
{

    public function __construct()
    {
        parent::__construct();
    }
    /* ============================================================================================ */
    /* ================================== profile-Start ======================================= */
    /* ============================================================================================ */


    public function encryptIt($q)
    {
        $cryptKey = "md5('B^7winer9^B')";
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }

    public function decryptIt($q)
    {
        $cryptKey = "md5('B^7winer9^B')";
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }

    public function autheticateUser($userName, $password)
    {

        $sql = "SELECT COUNT(*) FROM ra_owner WHERE email_id='$userName' AND password='$password'";
        $sth = $this->query($sql);

        if ($sth->fetchColumn() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($userName)
    {
        $sql = "SELECT * FROM ra_owner WHERE email_id='$userName'";
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetch();
    }

    public function autheticateEmail($eID)
    {
        $sql = "SELECT COUNT(*) FROM ra_owner WHERE email_id='$eID'";
        $sth = $this->query($sql);
        if ($sth->fetchColumn() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($modified_access, $username)
    {
        $sql = "UPDATE ra_owner SET user_access=:modified_access WHERE email_id=:username";
        $sth = $this->prepare($sql);
        $sth->bindParam(":modified_access", $modified_access);
        $sth->bindParam(":username", $username);
        return $sth->execute();
    }

    public function updateUserTime($modified_date, $username)
    {
        $sql = "UPDATE ra_owner SET user_date_modified=:modified_date WHERE email_id=:username";
        $sth = $this->prepare($sql);
        $sth->bindParam(":modified_date", $modified_date);
        $sth->bindParam(":username", $username);
        return $sth->execute();
    }


    public function updateUserPwd($new, $username)
    {
        $sql = "UPDATE ra_owner SET password=:new WHERE email_id=:username";
        $sth = $this->prepare($sql);
        $sth->bindParam(":new", $new);
        $sth->bindParam(":username", $username);
        return $sth->execute();
    }

    public function insertEmp($name, $emp_name, $emp_pwd, $create_date)
    {
        $sql = "INSERT INTO `ra_owner`(`email_id`, `password`, `user_date_created`, `name`, `is_active`) VALUES (:emp_name,:emp_pwd,:create_date,:name,1)";
        $sth = $this->prepare($sql);
        $sth->bindParam(":name", $name);
        $sth->bindParam(":emp_name", $emp_name);
        $sth->bindParam(":emp_pwd", $emp_pwd);
        $sth->bindParam(":create_date", $create_date);
        $sth->execute();
    }

    public function allEmp()
    {
        $sql = "SELECT * FROM ra_owner WHERE user_id!=1 ORDER BY name";
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    public function updateUserst($user, $stu)
    {
        $sql = "UPDATE ra_owner SET is_active=:stu WHERE user_id=:user";
        $sth = $this->prepare($sql);
        $sth->bindParam(":user", $user);
        $sth->bindParam(":stu", $stu);
        return $sth->execute();
    }

    public function deleteEmp($id)
    {
        $sql = "DELETE FROM ra_owner WHERE user_id='$id'";
        $sth = $this->exec($sql);
        if ($sth) {
            return true;
        } else {
            return false;
        }
    }

    /* ============================================================================================ */
    /* ================================== profile-Close ======================================= */
    /* ============================================================================================ */
}

?>