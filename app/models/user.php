<?php

class User extends AppModel
{
    public static function getAllUsers()
    {
        $db = DB::conn();
        $row = $db->rows('SELECT * FROM info');

        return $row ? $row : false;
    }

    public static function addUser($data = array())
    {
        $db = DB::conn();
        $db->begin();
            $db->insert('info', $data);
        $db->commit();

    }

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