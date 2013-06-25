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
     * @param array $data
     * @return bool|string
     */
    public static function addUser($data = array())
    {
        $db = DB::conn();

        try {
            $db->begin();
            $db->insert('info', $data);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            return $e->getMessage();
        }

        return true;
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

    /**
     * @param int $id
     * @return bool|string
     */
    public static function deleteUser($id = 0)
    {
        $db = DB::conn();

        try {
            if ($id > 0) {
                $sql = "DELETE FROM info WHERE id=$id";
                $db->begin();
                $db->query($sql);
                $db->commit();
            } else {
                throw new Exception("Error in deleting user's information");
            }
        } catch (Exception $e) {
            $db->rollback();
            return $e->getMessage();
        }

        return true;
    }
}