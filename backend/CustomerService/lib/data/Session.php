<?php

class Session
{
    public static function set($key, $value)
    {
        try {
            session_start();
            $_SESSION[$key] = $value;
        } catch (Exception $e) {
        }
    }

    public static function get($key)
    {
        try {
            session_start();
            return $_SESSION[$key];
        } catch (Exception $e) {
        }
    }

    public static function destroy()
    {
        try {
            session_start();
            session_destroy();
        } catch (Exception $e) {
        }
    }
}
