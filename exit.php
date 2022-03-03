<?php

session_start();

setcookie('hash', '', time() - 3600 * 24 * 3, '/');
unset($_COOKIE['hash']);

$_SESSION = [];

session_destroy();

header('Location: /');
