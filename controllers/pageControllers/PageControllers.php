<?php

class Controller
{
    public function home()
    {
        require_once 'views/home.php';
    }

    public function login()
    {
        require_once 'views/login.php';
    }

    public function register()
    {
        require_once 'views/register.php';
    }
}