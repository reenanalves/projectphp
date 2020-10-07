<?php

class Session {
    public static function set($key, $value){
        session_start();
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        session_start();
        return $_SESSION[$key];
    }

    public static function destroy(){
        session_start();
        session_destroy();
    }
}