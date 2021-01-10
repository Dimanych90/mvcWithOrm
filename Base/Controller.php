<?php


namespace Base;


class Controller
{

    /** @var View */
    public $view;


    public function redirect($url)
    {
        header("location:" . $url);
    }
}