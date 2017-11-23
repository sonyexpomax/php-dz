<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 21.11.17
 * Time: 10:15
 */
namespace App\Controllers;

use App\Core\Config;
use App\Core\Router;
use App\Core\Session;
use \App\Entity\Page;
use \App\Core\App;
use App\Entity\Users;

class UsersController extends Base
{
    /** @var Page  */
    private $usersModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->usersModel = new Users(App::getConnection());
    }



    public  function loginAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) && isset($_POST['password'])){

            $user = $this->usersModel->getByLogin(($_POST['login']));

            $hash = md5(Config::get('salt').$_POST['password']);

            if($user && $hash != $user['password']) {
                Session::addFlash('login or password incorrect');
                return false;
            }

            if($user['active'] == '0'){
                Session::addFlash("The login \"{$user['login']}\" has deactivated. Contact your administrator.");
                return false;
            }

                Session::set('login', $user['login']);
                Session::set('role', $user['role']);
                Router::redirect('/pages/');
        }

    }

    public function logoutAction(){
        Session::destroy();
        Router::redirect('/pages/');
    }

    public function registerAction(){
       // var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {

                if ($_POST['password'] != $_POST['confirm_password']) {
                    Session::addFlash('Password and confirm password must be same');
                    return false;
                }

                if (strlen($_POST['password']) < 7) {
                    Session::addFlash('You have entered less than 8 characters for password');
                    return false;
                }
                $_POST['role'] = 'user';

                if ($this->usersModel->getByLogin($_POST['login'])){
                    Session::addFlash("User with this login has already existed!");
                    return false;
                }

                $_POST['password'] = md5(Config::get('salt').$_POST['password']);

                $result = $this->usersModel->save($_POST);

                if (($result) == true) {
                    Session::addFlash("You have registered successfully");
                    Router::redirect('/users/login/');
                }
                else{
                    Session::addFlash("Error mysql");
                };
            }
            else {
                Session::addFlash('You must fill all of the fields');
                return false;
            }
        }

    }

}