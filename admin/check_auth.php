<?php

session_start();

// sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

if (isset($_COOKIE['hash'])) {
    $hash = $_COOKIE['hash'];

    // select user by hash
    require_once __DIR__ . '/../sql/select_user_by_hash.php';

    if (is_object($user) && $user->id > 0) {
        $_SESSION['user'] = $user->login;
        $_SESSION['role'] = $user->role;

        if ($_SESSION['role'] !== 'admin') {
            header('Location: ../');
            exit();
        }
    } else {
        setcookie('hash', '', time() - 3600 * 24 * 3, '/');
        unset($_COOKIE['hash']);

        $_SESSION = [];

        session_destroy();

        header('Location: ../');
        exit();
    }
} else {
    header('Location: ../');
    exit();
}