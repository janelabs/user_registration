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
     * @return bool
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
            return false;
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
            $row = $db->rows("SELECT * FROM info WHERE username = ?", array($uname));
        }

        return $row ? $row : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteUser($id = 0)
    {
        $db = DB::conn();

        try {
            if ($id) {
                $sql = "DELETE FROM info WHERE id = ?";
                $db->begin();
                $db->query($sql, array($id));
                $db->commit();
            } else {
                throw new Exception("Error in deleting user's information");
            }
        } catch (Exception $e) {
            $db->rollback();
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return array|bool
     */
    public static function getById($id = 0)
    {
        $db = DB::conn();
        $rows = array();

        if ($id) {
            $rows = $db->rows("SELECT * FROM info WHERE id = ?", array($id));
        }

        return $rows ? $rows : false;
    }

    /**
     * @param array $data
     * @param array $where
     * @return bool
     */
    public static function editUser($data = array(), $where = array())
    {
        $db = DB::conn();

        try {
            $db->begin();
            $db->update('info', $data, $where);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            return false;
        }

        return true;
    }
}