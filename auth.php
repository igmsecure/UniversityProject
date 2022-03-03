<?php

session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$method = $_GET['m'] ?? 'reg';

if ($method == 'log') {
    $title = 'Вход';
} else {
    $method = 'reg';
    $title = 'Регистрация';
}

// head
require_once __DIR__ . '/blocks/head.php';

?>

<body>
    <div class="auth-page">
		<a href="./" class="home-link">Главная</a>
		<div class="auth-block">
			<form>
                <input type="text" placeholder="Логин" class="js-auth-login" required/>

                <?php if ($method == 'reg'): ?>

				<input type="email" placeholder="Email" class="js-auth-email"/>

                <?php endif; ?>

				<input type="password" placeholder="Пароль" class="js-auth-pass" required/>
				<div class="error-mess js-error-block"></div>
				<button class="js-<?=$method;?>-user">
                    <?=$method == 'reg' ? 'Зарегестрироваться' : 'Войти';?>
                </button>
				<p class="message">

                <?php if ($method == 'reg'): ?>

                    Есть аккаунт?&nbsp;<a href="./auth.php?m=log">Войти</a>

                <?php else: ?>

                    Не зарегестрированы?&nbsp;<a href="./auth.php?m=reg">Зарегестрироваться</a>

                <?php endif; ?>
			</form>
		</div>
	</div>

    <script src="./includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>