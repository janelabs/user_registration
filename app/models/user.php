<?php

class User extends AppModel
{
    /**
     * @return array|bool
     */
    public static function getAllUsers()
    {
        $db = DB::conn();
        $row = $db->rows('SELECT * FROM info');

        return $row ? $row : false;
    }

    /**
     * Add new user
     *
     * @param array $data
     */
    public static function addUser($data = array())
    {
        $db = DB::conn();
        $db->begin();
            $db->insert('info', $data);
        $db->commit();
    }

    /**
     * @param null $uname
     * @return array|bool
     */
    public static function getByUsername($uname = null)
    {
        $db = DB::conn();
        $row = array();

        if ($uname) {
            $uname = mysql_real_escape_string($uname);
            $row = $db->rows("SELECT * FROM info WHERE username='{$uname}'");
        }

        return $row ? $row : false;
    }
}