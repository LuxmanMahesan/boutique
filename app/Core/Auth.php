<?php

class Auth
{
    public static function estConnecte()
    {
        return Session::get("user_id") !== null;
    }

    public static function exigerConnexion()
    {
        if (!self::estConnecte()) {
            header("Location: /boutique/public/?page=login");
            exit;
        }
    }
}
