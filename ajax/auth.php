<?php

//sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
$method = trim(filter_var($_POST['method'], FILTER_SANITIZE_STRING));

$error = '';

if ($method == 'reg') {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    if (strlen($login) < 5) {
        $error = 'Слишком короткий логин';
    } else if (strlen($email) < 8) {
        $error = 'Слишком короткий Email';
    } elseif (strlen($pass) < 8) {
        $error = 'Слишком короткий пароль';
    }

    if ($error != '') {
        echo $error;
        exit();
    }

    // select user id by login
    require_once __DIR__ . '/../sql/select_user_id.php';

    if (!is_object($user) || $user->id == 0) {
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        // reg user
        require_once __DIR__ . '/../sql/reg_user.php';
    } else {
        echo 'Логин занят';
        exit();
    }
} else {
    // select user
    require_once __DIR__ . '/../sql/select_user.php';

    if (!is_object($user) || $user->id == 0) {
        echo 'Неправильный логин';
        exit();
    } else {
        $hash = $user->hash;
        
        if (!password_verify($pass, $hash)) {
            echo 'Неправильный пароль';
            exit();
        }
    }
}

setcookie('hash', $hash, time() + 3600 * 24 * 3, '/');

echo 'Ok';
