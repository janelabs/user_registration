<?php

class User extends AppModel
{
    public static function getAllUsers()
    {
        $db = DB::conn();
        $row = $db->rows('SELECT * from info');

        return $row ? $row : false;
    }

    public static function addUser()
    {
        $db = DB::conn();
        $sql = "INSERT INTO info (lastname, firstname, middlename, email, password)
        VALUES('')";
    }
}