<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:25
 */

namespace App\Controllers\Admin;

use App\Core\Config;
use App\Core\Router;
use App\Core\Session;
use \App\Core\App;
use App\Entity\User;

class UsersController extends \App\Controllers\Base
{
    /** @var Page  */
    private $userModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->userModel = new User(App::getConnection());
    }

    public function indexAction()
    {
        $this->data = $this->userModel->list();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['active'])) {
            $dataActive = "";
            $postActive = "";
            foreach ($this->data as $value){
                $dataActive = (string) $value['active'];
                if(isset($_POST['active'][$value['id']][0])){
                    $postActive =  "1";
                }else{
                    $postActive =  "0";
                }

                if($dataActive != $postActive){
              //      echo "dataActive = $dataActive  -------- postActive = $postActive";
                    if ($postActive == "0"){
                        $result = $this->userModel->deactivate($value['id']);
                        var_dump($result);
                        if ($result){
                            Session::addFlash("User \"{$value['login']}\" has deactivated");

                        }else{
                            Session::addFlash("Error with deactivation user \"{$value['login']}\"!");
                        }
                    }
                    elseif ($postActive == "1"){
                        $result = $this->userModel->activate($value['id']);
                        if ($result){
                            Session::addFlash("User \"{$value['login']}\" has activated");
                        }else{
                            Session::addFlash("Error with activation user \"{$value['login']}\"!");
                        }
                    }

                }
            }
            Router::redirect("/admin/users/");
        }

    }



    public function deleteAction()
    {
        $id = isset($this->params[0]) ? $this->params[0] : null;

        if (!$id) {
            Session::addFlash('Missing user id');
        } elseif ($this->userModel->delete($id)) {
            Session::addFlash('user has been deleted');
        } else {
            Session::addFlash('Couldn\'t delete user');
        }

        App::getRouter()->redirect(
            App::getRouter()->buildUri('index')
        );
    }

    public  function loginAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            try {
                $user = $this->userModel->login($_POST, "admin");
            } catch (\Exception $e) {
                Session::addFlash($e->getMessage());
                return;
            }

            Session::set('login', $user['login']);
            Session::set('role', $user['role']);
            Router::redirect('/admin/pages/');
        }
    }


    public function logoutAction(){
        Session::destroy();
        Router::redirect('admin/users/login/');
    }

}

