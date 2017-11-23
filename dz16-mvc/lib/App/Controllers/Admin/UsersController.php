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
use App\Entity\Contacts;
use \App\Entity\Page;
use \App\Core\App;
use App\Entity\Users;

class UsersController extends \App\Controllers\Base
{
    /** @var Page  */
    private $usersModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->usersModel = new Users(App::getConnection());
    }

    public function indexAction()
    {
        $this->data = $this->usersModel->list();

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
                        $result = $this->deactivate($value['id']);
                        var_dump($result);
                        if ($result){
                            Session::addFlash("User \"{$value['login']}\" has deactivated");

                        }else{
                            Session::addFlash("Error with deactivation user \"{$value['login']}\"!");
                        }
                    }
                    elseif ($postActive == "1"){
                        $result = $this->activate($value['id']);
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

    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $id = isset($this->params[0]) ? $this->params[0] : null;
                $this->data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'messages' => $_POST['messages'],
                    'new' => true,
                ];
                $this->usersModel->save($this->data, $id);

                Session::addFlash('Message has been saved');
                Router::redirect(   App::getRouter()->buildUri('index')  );

            } catch (\Exception $e) {
               Session::addFlash($e->getMessage());
            }
        }

        if (isset($this->params[0]) && $this->params[0] > 0) {
            $this->data = $this->usersModel->getById($this->params[0]);
        }
    }

    public function deleteAction()
    {
        $id = isset($this->params[0]) ? $this->params[0] : null;

        if (!$id) {
            Session::addFlash('Missing user id');
        } elseif ($this->usersModel->delete($id)) {
            Session::addFlash('user has been deleted');
        } else {
            Session::addFlash('Couldn\'t delete user');
        }

        App::getRouter()->redirect(
            App::getRouter()->buildUri('index')
        );
    }

    public function activate($id){
       return $this->usersModel->save(['active'=> '1'], $id);
    }

    public function deactivate($id){
       return $this->usersModel->save(['active'=> '0'], $id);
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

            if($user['role'] != 'admin'){
                Session::addFlash("The login \"{$user['login']}\" does not have admin rights.");
                return false;
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

