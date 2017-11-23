<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:25
 */

namespace App\Controllers;

use App\Core\Router;
use App\Core\Session;
use App\Entity\Contacts;
use \App\Entity\Page;
use \App\Core\App;

class ContactsController extends Base {

    private $contactsModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->contactsModel = new Contacts(App::getConnection());
    }

    public function index(){

    }


    public function indexAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['messages'])) {
                $result = $this->contactsModel->save($_POST);
                if ($result) {
                    Session::addFlash('Thanky you! your message was send successfully');
                //    Router::redirect('/contacts/');
                } else {
                    Session::addFlash('Error. Check the form!');;
                }
            }
            else{
                Session::addFlash('You must fill all of the fields');
            }
        }
    }
}