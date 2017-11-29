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

class User extends Base
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
        var_dump($result);
        return isset($result[0]) ? $result[0] : null;
    }

    public function activate($id){
        return $this->save(['active'=> '1'], $id);
    }

    public function deactivate($id){
        return $this->save(['active'=> '0'], $id);
    }

    public function register(array $data){

            if (!isset($data['login']) || !isset($data['password']) || !isset($data['confirm_password']) || !isset($data['email'])) {
                throw new \Exception('You must fill all of the fields');
            }

            if ($data['password'] != $data['confirm_password']) {
                throw new \Exception('Password and confirm password must be same');
            }

            if (strlen($data['password']) < 7) {
                throw new \Exception('You have entered less than 8 characters for password');
            }

            if ($this->getByLogin($data['login'])){
                throw new \Exception('User with this login has already existed!');
            }


            $data['password'] = md5(Config::get('salt').$data['password']);
            $data['role'] = 'user';

            $result = $this->save($data);

            return $result;
    }

    public function login(array $data, $role){
        if (!isset($data['login']) || !isset($data['password'])) {
            throw new \Exception('You must fill all of the fields');
        }

        $user = $this->getByLogin(($data['login']));

        if(!$user) {
            throw new \Exception('User with this login not found');
        }

        $hash = md5(Config::get('salt').$data['password']);

        if($hash != $user['password']) {
            throw new \Exception('Password incorrect');
        }

        if($user['role'] != $role) {
            throw new \Exception('You do not have the necessary privileges to login as '.$role);
        }


        if($user['active'] == '0'){
            throw new \Exception("The login \"{$user['login']}\" has deactivated. Contact your administrator.");
        }

        return $user;
    }

}