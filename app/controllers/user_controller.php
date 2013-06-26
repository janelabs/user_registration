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

    private function edit($uid = 0, $info = array())
    {
        if ($uid > 0 && count($info) > 0) {
            $info['date_modified'] = date('Y-m-d H:i:s');
            $where = array('id' => $uid);

            $edit_user = User::editUser($info, $where);

            // check if insert of new user is successful
            if ($edit_user) {
                header('Location: ' . url('user/index'));
            } else {
                throw new Exception("Error in editing user's information.");
            }
        } else {
            throw new Exception("Error in editing user's information.");
        }

    }

    private function register($info = array())
    {
        if (count($info) > 0) {
            $info['date_registered'] = date('Y-m-d H:i:s');

            $new_user = User::addUser($info);

            // check if insert of new user is successful
            if ($new_user) {
                header('Location: ' . url('user/index'));
            } else {
                throw new Exception('Error in adding new user.');
            }
        } else {
            throw new Exception('Error in adding new user.');
        }
    }

    /**
     * User Info Form Display - used in Add New User and Edit User's Info
     * Uses $uid variable to check if form is for add or edit
     */
    public function info()
    {
        $info = array();
        $error = null;
        $uid = Param::get('id', 0);
        $title = "Register"; // determines the title/header of the form
        $submit_value = "Register"; // determines the value of the submit button

        // check if for edit
        if ($uid > 0) {
            $user = User::getById($uid);

            if ($user) {
                $lastname = $user[0]['lastname'];
                $firstname = $user[0]['firstname'];
                $middlename = $user[0]['middlename'];
                $username = $user[0]['username'];
                $last_date_modified = $user[0]['date_modified'];
                if ($last_date_modified == "0000-00-00 00:00:00") {
                    $last_date_modified = null;
                }

                $title = "Edit";
                $submit_value = "Save";
            }
        }

        if (isset($_POST['info_btn'])) {
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

                    // check if form is for edit purpose
                    if ($uid > 0 ) {
                        if ($uname && $uname[0]['id'] != $uid) {
                            throw new Exception('Username already taken.');
                        }
                    } else {
                        if ($uname) {
                            throw new Exception('Username already taken.');
                        }
                    }

                    $info['username'] = $username;
                } else {
                    throw new Exception('All fields are required.');
                }

                if (!$uid) {
                    if (has_content($password)) {
                        if (!validate_min($password, 6)) {
                            throw new Exception('Password must be at least 6 characters');
                        }
                        $info['password'] = md5(ENC_KEY . $password);
                    } else {
                        throw new Exception('sdasdAll fields are required.');
                    }
                }

                // end validation

                // checks if edit or insert
                if ($uid > 0) {
                    $this->edit($uid, $info);
                } else {
                    $this->register($info);
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
