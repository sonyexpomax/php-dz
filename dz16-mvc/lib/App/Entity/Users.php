<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.11.17
 * Time: 19:06
 */

namespace App\Entity;

use App\Core\Config;
use App\Core\Router;
use App\Core\Session;

class Users extends Base
{
    public function getTableName()
    {
        return 'users';
    }

    public function getFields()
    {
        return [
            'id',
            'login',
            'role',
            'email',
            'password',
            'active',
        ];
    }

    public function checkFields($data)
    {
        foreach ($data as $key => $val) {
            if (!is_string($data[$key])) {
                Session::addFlash("Field {$key} incorrect");
                return false;
            }
        }
        return true;
    }

    public function getByLogin($login)
    {
        $sql = 'SELECT * FROM users WHERE login = '.$this->conn->escape($login).' LIMIT 1';
        $result = $this->conn->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }
/*
    public function save($data, $id=null){
        if($this->checkFields($data)) {

            $user = $this->conn->escape($data['login']);
            $password = $data['password'];
            $email = $this->conn->escape($data['email']);
            $role = $this->conn->escape($data['role']);
            $hash = md5(Config::get('salt').$password);
            $sql = "INSERT INTO users (`login`, `email`, `role`, `password`, `active`) VALUES ({$user}, {$email}, {$role}, '{$hash}', '1');";
            return $this->conn->query($sql);
        }
    }
*/
}