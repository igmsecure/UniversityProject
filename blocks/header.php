<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="header-logo">
                <a href="/">
                    <img src="/icons/logo.svg" alt="logo">
                    <h2>BMSTU FOOD</h2>
                </a>
            </div>
            <h2 class="header-title">BMSTU FOOD</h2>

            <?php if (isset($_SESSION['user'])): ?>

            <h5 class="user-name">Привет, <?=$_SESSION['user'];?>!</h5>

            <?php

            if ($_SESSION['role'] == 'admin') {
                echo "<a href='/admin/index.php' class='admin-link'>Админка</a>";
            }

            ?>

            <button class="logout-btn">
                <a href="/exit.php">Выход</a>
            </button>

            <?php endif; ?>
            
            <a href="#" class="header-link">Версия для слабовидящих</a>
            <div class="header-menu js-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>