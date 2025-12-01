<?php

class Session
{
    public static function demarrer()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($cle, $val)
    {
        $_SESSION[$cle] = $val;
    }

    public static function get($cle)
    {
        return isset($_SESSION[$cle]) ? $_SESSION[$cle] : null;
    }

    public static function detruire()
    {
        session_destroy();
    }
}
