<?php

class UserController extends AppController
{
    public function index()
    {
        $users = User::getAllUsers();
        $this->set(get_defined_vars());
    }

    public function register()
    {

    }

    public function addUser()
    {

    }
}
