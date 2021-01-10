<?php


namespace Base;


use Dotenv\Dotenv;

class Application
{
    public function ini()
    {
        $env = Dotenv::createImmutable(__DIR__ . '/../');
        $env->load();

        $session = new Session();

    }

    public function run()
    {
        $this->ini();
        $dispetcher = new Dispetcher();

        $dispetcher->dispatch();

        $controllerName = $dispetcher->getClassName();

        $actionName = $dispetcher->getActionName();

        $contrName = new $controllerName;

        $view = new View();

        $contrName->view = $view;

        $view->getTplName(__DIR__ . "\\..\\App\\view\\");

        $contrName->$actionName();

    }
}