<?php
class Param
{
    public static function get($name, $default = null)
    {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    public static function params()
    {
        return $_REQUEST;
    }

    public static function post($name = null, $default = null)
    {
        if ($name === null) {
            return $_POST;
        }

        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }
}
