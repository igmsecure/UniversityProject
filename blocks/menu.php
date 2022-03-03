<div class="mobile-menu js-mobile-menu">
   <ul class="mobile-menu__ul">
        <li>
            <a href="/">Главная</a>
        </li>
        <li>
            <a href="#">Обратная связь</a>
        </li>
        <li>
            <a href="#">Информация</a>
        </li>
        <li>
            <a href="#">Версия для слабовидящих</a>
        </li>

        <?php if (isset($_SESSION['user'])): ?>

        <li>
            Привет, <?=$_SESSION['user'];?>!
        </li>

        <?php

        if ($_SESSION['role'] == 'admin') {
            echo "
            <li>
                <a href='/admin/index.php'>Админка</a>
            </li>
            ";
        }

        ?>

        <li>
            <a href="/exit.php">Выход</a>
        </li>

        <?php endif; ?>
   </ul>
</div>