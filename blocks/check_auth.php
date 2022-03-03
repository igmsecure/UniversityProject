<?php

session_start();

if (isset($_COOKIE['hash'])) {
    $hash = $_COOKIE['hash'];

    // select user by hash
    require_once __DIR__ . '/../sql/select_user_by_hash.php';

    if (is_object($user) && $user->id > 0) {
        $_SESSION['user'] = $user->login;
        $_SESSION['role'] = $user->role;
    } else {
        setcookie('hash', '', time() - 3600 * 24 * 3, '/');
        unset($_COOKIE['hash']);

        $_SESSION = [];

        session_destroy();
    }
}
