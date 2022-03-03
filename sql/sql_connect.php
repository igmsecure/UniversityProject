<?php

function mysqlConnect()
{
    $user = 'root';
    $password = '';
    $db = 'points';
    $host = 'localhost';
    $charset = 'utf8';
    $dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=' . $charset;

    static $pdo = null;

    if (is_null($pdo)) {
        try {
            $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    return $pdo;
}
