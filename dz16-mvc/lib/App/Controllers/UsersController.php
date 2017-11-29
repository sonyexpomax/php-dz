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
use \App\Core\App;
use App\Entity\User;

class UsersController extends Base
{
    /** @var Page  */
    private $userModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->userModel = new User(App::getConnection());
    }



    public  function loginAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            try {
                $user = $this->userModel->login($_POST, "user");
            } catch (\Exception $e) {
                Session::addFlash($e->getMessage());
                return;
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $role = 'user';
            try {
                $this->userModel->register($_POST);
            } catch (\Exception $e) {
                Session::addFlash($e->getMessage());
                return;
            }

            Session::addFlash("You have registered successfully");
            Router::redirect('/users/login/');
        }
    }

}