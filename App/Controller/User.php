<?php

namespace App\Controller;

use Base\Controller;
use Base\Session;
use Base\View;

class User extends Controller
{
    /** @var View */
    public $view;

    public function registerAction()
    {
        if (!empty($_POST['name'])) {
            $user = new \App\Model\User();
            $user->set($_POST['name'], 'name');
            if (!empty($_POST['password'])) {
                $user->set($_POST['password'], 'password');
                if (!empty($_POST['email'])) {
                    $user->set($_POST['email'], 'email');
                }
                if (!empty($_POST['birth_date'])) {
                    $user->set($_POST['birth_date'], 'birth_date');
                    $age = $user->carbon($_POST['birth_date']);
                    if ($age < 18) {
                        echo "you are too yang for this site<br>";
                        die();
                    }
                }
                if ($user->gump() === true) {
                    $user->register();
                } elseif (empty($_POST['password'])) {
                    $this->redirect("/register");
                    die();
                } elseif (empty($_POST['email'])) {
                    $this->redirect("/login");
                } elseif (empty($_POST['birth_date'])) {
                    $user->set($_POST['birth_date'], 'birth_date');
                }

            } elseif (empty($_POST['name'])) {
                $this->redirect("/login");
            }
        }
        $this->view->render("user/user.phtml", ["title" => "You need to register at first"]);
    }

    public function authorizeAction()
    {
        if (!empty($_POST['name'])) {
            $user = new \App\Model\User();
            $user->set($_POST['name'], 'name');
            if (!empty($_POST['password'])) {
                $user->set(sha1($_POST['password']), 'password');
                if ($user->authorize() == true) {
                    $user_id = $user->getId();
                    Session::setId($user_id);
                    $this->view->render("user/logined.phtml", ['title' => '']);
                }
                if ($user->authorize() == false) {
                    $this->redirect("/login");
                }
            }
        } else {
            $this->redirect("/login");
        }
    }

    public function listAction()
    {
        $users = \App\Model\User::userlist();

        $this->view->render("user/list.phtml", ["users" => $users]);

    }
}