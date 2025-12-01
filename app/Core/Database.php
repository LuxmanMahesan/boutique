<?php

class Database
{
    private static $pdo;

    public static function connexion()
    {
        if (!self::$pdo) {
            $host = "localhost";
            $port = "3307";
            $dbname = "boutique";
            $user = "root";
            $pass = "";

            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }

        return self::$pdo;
    }
}
