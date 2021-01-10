<?php


namespace Base;


class Session
{

    const ID = 'user_id';
    const USERS_MACHINE = 'users_machine';
    const USER_IP = 'user_ip';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    public static function setId($id)
    {
        $_SESSION['id'] = $id;
        return $_SESSION['id'];
    }

    public static function getId()
    {
        return $_SESSION['id'];
    }


}