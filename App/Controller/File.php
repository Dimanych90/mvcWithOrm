<?php


namespace App\Controller;


use Base\Controller;
use Base\Session;
use Base\View;

class File extends Controller
{
    /** @var View */
    public $view;

    public function uploadAction()
    {
        if (!empty($_FILES['photo']['name'])) {
            $file = new \App\Model\FIle();
            $file->set($_FILES['photo']['name'], 'filename');
            $user_id = Session::getId();
            $file->set($user_id, 'user_id');
            $file->set($_FILES['photo']['size'], 'size');
//            \App\Model\FIle::uploadedFiles($_FILES['photo']['name'], $_FILES['photo']['tmp_name']);
            \App\Model\FIle::imageUpload($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);
            $file->save();
            $this->redirect("../post/sendPost");
//            $this->view->render("post/post.phtml",["title" => "Posts"]);
        } elseif (empty($_FILES['name'])) {
            $this->redirect("../post/sendPost");
//            $this->view->render("post/post.phtml",["title" => "Posts"]);
        }
    }
}