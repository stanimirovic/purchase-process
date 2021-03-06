<?php

namespace model;


use common\base\BaseModel;
use modelRepository\UserRepository;

class User extends BaseModel
{
    const ADMINISTRATOR = 1;
    const EMPLOYEE = 2;
    const SUPPLIER = 3;

    private $possibleRole = [self::ADMINISTRATOR, self::EMPLOYEE, self::SUPPLIER];

    protected $username;
    protected $email;
    protected $password;
    protected $oldPassword;
    protected $newPassword;
    protected $newRepeatedPassword;
    protected $role;

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    public function getNewPassword()
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function getNewRepeatedPassword()
    {
        return $this->newRepeatedPassword;
    }

    public function setNewRepeatedPassword(string $newRepeatedPassword)
    {
        $this->newRepeatedPassword = $newRepeatedPassword;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole(int $role)
    {
        if (!in_array($role, $this->possibleRole)) {
            throw new \Exception('Error in setRole function: Denied value for $role variable.');
        }
        $this->role = $role;
    }

    public function populate(array $dbRow): BaseModel
    {
        $this->setUsername($dbRow['username']);
        $this->setEmail($dbRow['email']);
        $this->setPassword($dbRow['password']);
        $this->setRole($dbRow['role']);
        return parent::populate($dbRow);
    }

    public function getFieldMapping(): array
    {
        return array_merge_recursive(
            array(
                'username' => array(
                    'columnName' => '`username`',
                    'columnType' => \PDO::PARAM_STR,
                    'columnSize' => 30,
                    'columnValue' => $this->getUsername()
                ),
                'email' => array(
                    'columnName' => '`email`',
                    'columnType' => \PDO::PARAM_STR,
                    'columnSize' => 50,
                    'columnValue' => $this->getEmail()
                ),
                'password' => array(
                    'columnName' => '`password`',
                    'columnType' => \PDO::PARAM_STR,
                    'columnSize' => 30,
                    'columnValue' => $this->getPassword()
                ),
                'role' => array(
                    'columnName' => '`role`',
                    'columnType' => \PDO::PARAM_INT,
                    'columnValue' => $this->getRole()
                )
            ),
            parent::getFieldMapping()
        );
    }

    public static function getTableName(): string
    {
        return '`user`';
    }

    protected function validate(): array
    {
        $errors = array();
        $this->username = trim($this->username);
        $this->email = trim($this->email);

        if (strlen($this->username) === 0) {
            $errors['username'][] = 'Korisničko ime ne sme da bude prazno polje.';
        } else if (strlen($this->username) > 30) {
            $errors['username'][] = 'Maksimalan broj karaktera za korisničko ime je 30.';
        } else if ($this->isDuplicateUsername()) {
            $errors['username'][] = 'Korisnik sa unetim korisničkim imenom već postoji.';
        }

        if (strlen($this->email) === 0) {
            $errors['email'][] = 'E-mail ne sme da bude prazno polje.';
        } else if (strlen($this->email) > 50) {
            $errors['email'][] = 'Maksimalan broj karaktera za e-mail je 50.';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'E-mail mora biti u formatu example@example.com.';
        } else if ($this->isDuplicateEmail()) {
            $errors['email'][] = 'Korisnik sa unetim e-mail-om već postoji.';
        }

        if (strlen($this->oldPassword) !== 0 || strlen($this->newPassword) !== 0 || strlen($this->newRepeatedPassword) !== 0) {
            if (strlen($this->newPassword) === 0) {
                $errors['newPassword'][] = 'Nova lozinka ne sme da bude prazno polje.';
            } else if (strlen($this->newPassword) > 30) {
                $errors['newPassword'][] = 'Maksimalan broj karaktera za lozinku je 30.';
            }

            if (strlen($this->newPassword) > 0 && strlen($this->newRepeatedPassword) === 0) {
                $errors['newRepeatedPassword'][] = 'Ponovite novu lozinku.';
            } else if ($this->newPassword !== $this->newRepeatedPassword) {
                $errors['newRepeatedPassword'][] = 'Nova lozinka i ponovljena lozinka se ne poklapaju.';
            }

            if (strlen($this->oldPassword) === 0) {
                $errors['oldPassword'][] = 'Unesite staru lozinku.';
            } else if ($this->oldPassword !== $this->password) {
                $errors['oldPassword'][] = 'Pogrešna stara lozinka.';
            }

            if (empty($errors)) {
                $this->password = $this->newPassword;
            }
        }

        return $errors;
    }

    private function isDuplicateUsername(): bool
    {
        $userRepository = new UserRepository();
        $usernameColumnName = '`username`';
        $duplicateUser = $userRepository->loadOne(true, $usernameColumnName . ' = ' . $this->getDb()->quote($this->username));

        if (empty($duplicateUser)) {
            return false;
        }

        if ($this->getId() === $duplicateUser->getId()) {
            return false;
        }
        return true;
    }

    private function isDuplicateEmail(): bool
    {
        $userRepository = new UserRepository();
        $emailColumnName = '`email`';
        $duplicateUser = $userRepository->loadOne(true, $emailColumnName . ' = "' . $this->email . '"');

        if (empty($duplicateUser)) {
            return false;
        }

        if ($this->getId() === $duplicateUser->getId()) {
            return false;
        }
        return true;
    }
}