<?php


namespace Base;


use App\Controller\User;

class Dispetcher
{
    private $_className;
    private $_actionName;


    public function dispatch()
    {
        $parts = explode("/", $_SERVER['REQUEST_URI']);

//        $this->_className = $parts[1];
//        $this->_actionName = $parts[2];

        $routes = ["/login" => [User::class, 'register'],
            "/register" => [User::class, 'register'],
            "/" => [User::class, 'register']];


        if (isset($routes[$_SERVER["REQUEST_URI"]])) {
            $this->_className = $routes[$_SERVER["REQUEST_URI"]][0] ?? ucfirst($parts[1]);
            $this->_actionName = $routes[$_SERVER["REQUEST_URI"]][1] . "Action" ?? "registerAction";
        } elseif (!isset($rotes[$_SERVER["REQUEST_URI"]])) {
            $this->_className = "App\\Controller\\".ucfirst($parts[1]);
            $this->_actionName = $parts[2] . "Action";
        }
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->_className;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->_actionName;
    }


}