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
        $info = array();
        $error = null;
        $lastname = "";
        $firstname = "";
        $middlename = "";
        $username = "";
        $password = "";

        if (Param::get('register_btn')) {
            $lastname = trim(Param::get('lastname'));
            $firstname = trim(Param::get('firstname'));
            $middlename = trim(Param::get('middlename'));
            $username = trim(Param::get('username'));
            $password = trim(Param::get('password'));

            try {
                // validate input
                if (has_content($lastname)) {
                    $info['lastname'] = $lastname;
                } else {
                    throw new Exception('All fields are required.');
                }

                if (has_content($firstname)) {
                    $info['firstname'] = $firstname;
                } else {
                    throw new Exception('All fields are required.');
                }

                if (has_content($middlename)) {
                    $info['middlename'] = $middlename;
                } else {
                    throw new Exception('All fields are required.');
                }

                if (has_content($username)) {
                    if (User::getByUsername($username)) {
                        throw new Exception('Username already taken.');
                    }
                    $info['username'] = $username;
                } else {
                    throw new Exception('All fields are required.');
                }

                if (has_content($password)) {
                    if (!validate_min($password, 6)) {
                        throw new Exception('Password must be at least 6 characters');
                    }
                    $info['password'] = md5(ENC_KEY . $password);
                } else {
                    throw new Exception('All fields are required.');
                }
                // end validation

                User::addUser($info);
                header('Location: ' . url('user/index'));

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $this->set(get_defined_vars());
    }
}
