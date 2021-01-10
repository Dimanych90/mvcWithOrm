<?php


namespace App\Controller;


use Base\Controller;
use Base\Session;
use Base\View;

class Post extends Controller
{
    /** @var View */
    public $view;

    public function sendPostAction()
    {
        if (!empty($_POST['message']) || !empty($_FILES['userfile']['name'])) {
            $post = new \App\Model\Post();
            $post->set($_POST['message'], 'message');
            $user_id = Session::getId();
            $post->set($user_id, 'user_id');
            if (!empty($_FILES['userfile']['name'])) {
                \App\Model\Post::imageUser($_FILES['userfile']['tmp_name'],
                    $_FILES['userfile']['name']);
                $post->set($_FILES['userfile']['name'], 'filename');
            }
            $post->saveAll();
        }
        $this->redirect("post");
//        $this->view->render("post/post.phtml", ['title' => 'Posts']);
    }

    public function postAction()
    {
        $users = \App\Model\User::userlist();

        $posts = \App\Model\Post::postList();

        $this->view->render("post/post.phtml",["users" => $users, "posts" => $posts]);
    }
}