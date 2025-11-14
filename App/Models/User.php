<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\BaseModel;
use PDO;

class User extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Authenticate user credentials
     */
    public function authenticateUser(string $userName, string $password): bool
    {
        $sql = "SELECT COUNT(*) FROM ra_owner WHERE email_id = :userName AND password = :password";
        $sth = $this->prepare($sql);
        $sth->bindParam(':userName', $userName);
        $sth->bindParam(':password', $password);
        $sth->execute();
        
        return $sth->fetchColumn() == 1;
    }

    /**
     * Get user by username
     */
    public function getUser(string $userName): ?object
    {
        $sql = "SELECT * FROM ra_owner WHERE email_id = :userName";
        $sth = $this->prepare($sql);
        $sth->bindParam(':userName', $userName);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetch() ?: null;
    }

    /**
     * Check if email exists
     */
    public function authenticateEmail(string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM ra_owner WHERE email_id = :email";
        $sth = $this->prepare($sql);
        $sth->bindParam(':email', $email);
        $sth->execute();
        
        return $sth->fetchColumn() == 1;
    }

    /**
     * Update user access
     */
    public function updateUser(string $modifiedAccess, string $username): bool
    {
        $sql = "UPDATE ra_owner SET user_access = :modifiedAccess WHERE email_id = :username";
        $sth = $this->prepare($sql);
        $sth->bindParam(':modifiedAccess', $modifiedAccess);
        $sth->bindParam(':username', $username);
        return $sth->execute();
    }

    /**
     * Update user modified time
     */
    public function updateUserTime(string $modifiedDate, string $username): bool
    {
        $sql = "UPDATE ra_owner SET user_date_modified = :modifiedDate WHERE email_id = :username";
        $sth = $this->prepare($sql);
        $sth->bindParam(':modifiedDate', $modifiedDate);
        $sth->bindParam(':username', $username);
        return $sth->execute();
    }

    /**
     * Update user password
     */
    public function updateUserPassword(string $newPassword, string $username): bool
    {
        $sql = "UPDATE ra_owner SET password = :newPassword WHERE email_id = :username";
        $sth = $this->prepare($sql);
        $sth->bindParam(':newPassword', $newPassword);
        $sth->bindParam(':username', $username);
        return $sth->execute();
    }

    /**
     * Insert new employee
     */
    public function insertEmployee(string $name, string $empName, string $empPwd, string $createDate): void
    {
        $sql = "INSERT INTO ra_owner (email_id, password, user_date_created, name, is_active) 
                VALUES (:empName, :empPwd, :createDate, :name, 1)";
        $sth = $this->prepare($sql);
        $sth->bindParam(':name', $name);
        $sth->bindParam(':empName', $empName);
        $sth->bindParam(':empPwd', $empPwd);
        $sth->bindParam(':createDate', $createDate);
        $sth->execute();
    }

    /**
     * Get all employees
     */
    public function allEmployees(): array
    {
        $sql = "SELECT * FROM ra_owner WHERE user_id != 1 ORDER BY name";
        $sth = $this->query($sql);
        $sth->setFetchMode(PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    /**
     * Update user status
     */
    public function updateUserStatus(int $userId, int $status): bool
    {
        $sql = "UPDATE ra_owner SET is_active = :status WHERE user_id = :userId";
        $sth = $this->prepare($sql);
        $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
        $sth->bindParam(':status', $status, PDO::PARAM_INT);
        return $sth->execute();
    }

    /**
     * Delete employee
     */
    public function deleteEmployee(int $id): bool
    {
        $sql = "DELETE FROM ra_owner WHERE user_id = :id";
        $sth = $this->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }
}

