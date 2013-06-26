<?php

class UserController extends AppController
{
    public function index()
    {
        $users = User::getAllUsers();

        $adapter = new \Pagerfanta\Adapter\ArrayAdapter($users);
        $paginator = new \Pagerfanta\Pagerfanta($adapter);
        $paginator->setMaxPerPage(10);

        // check if defined page is greater than the rendered page
        $total_page = $paginator->getNbPages();
        $current_page = (int) Param::get('page', 1);

        if ($current_page > $total_page) {
            header('Location: ' . url('user/index'));
        } else {
            $paginator->setCurrentPage(Param::get('page', 1));
        }

        $users = $paginator->getCurrentPageResults();

        $view = new \Pagerfanta\View\DefaultView();
        $options = array('proximity' => 3, 'url' => 'user/index');
        $page = $view->render($paginator, 'routeGenerator', $options);

        $this->set(get_defined_vars());
    }

    public function register()
    {
        $info = array();
        $error = null;

        if (isset($_POST['register_btn'])) {
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

                $info['date_registered'] = date('Y-m-d H:i:s');

                $new_user = User::addUser($info);

                // check if insert of new user is successful
                if ($new_user) {
                    header('Location: ' . url('user/index'));
                } else {
                    echo $new_user;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $this->set(get_defined_vars());
    }

    public function deleteUser()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;

        if ($id && is_numeric($id)) {
            $del_user = User::deleteUser((int) $id);
            header('Location: ' . url('user/index'));
        } else {
            echo "Invalid action";
        }
    }

    public function edit()
    {
        $info = array();
        $error = null;
        $uid = Param::get('id', 0);

        if ($uid > 0) {
            $user = User::getById($uid);

            $lastname = $user[0]['lastname'];
            $firstname = $user[0]['firstname'];
            $middlename = $user[0]['middlename'];
            $username = $user[0]['username'];
            $password = $user[0]['password'];
        }

        if (isset($_POST['edit_btn'])) {
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
                    $uname = User::getByUsername($username);
                    if ($uname && $uname[0]['id'] != $uid) {
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

                $info['date_registered'] = date('Y-m-d H:i:s');

                $where = array('id' => $uid);
                $edit_user = User::editUser($info, $where);

                // check if insert of new user is successful
                if ($edit_user) {
                    header('Location: ' . url('user/index'));
                } else {
                    echo $edit_user;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $this->set(get_defined_vars());
    }
}
