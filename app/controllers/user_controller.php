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
}
