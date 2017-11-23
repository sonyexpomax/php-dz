<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 19:25
 */

namespace App\Controllers\Admin;

use App\Core\Router;
use App\Core\Session;
use App\Entity\Contacts;
use \App\Entity\Page;
use \App\Core\App;

class ContactsController extends \App\Controllers\Base
{
    /** @var Page  */
    private $contactsModel;

    public function __construct($params = [])
    {
        parent::__construct($params);

        $this->contactsModel = new Contacts(App::getConnection());
    }

    public function indexAction()
    {
        $this->data = $this->contactsModel->list();
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
                $this->contactsModel->save($this->data, $id);

                Session::addFlash('Message has been saved');
                Router::redirect(   App::getRouter()->buildUri('index')  );

            } catch (\Exception $e) {
               Session::addFlash($e->getMessage());
            }
        }

        if (isset($this->params[0]) && $this->params[0] > 0) {
            $this->data = $this->contactsModel->getById($this->params[0]);
        }
    }

    public function deleteAction()
    {
        $id = isset($this->params[0]) ? $this->params[0] : null;

        if (!$id) {
            Session::addFlash('Missing message id');
        } elseif ($this->contactsModel->delete($id)) {
            Session::addFlash('Message has been deleted');
        } else {
            Session::addFlash('Couldn\'t delete Message');
        }

        App::getRouter()->redirect(
            App::getRouter()->buildUri('index')
        );
    }
}