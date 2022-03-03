<?php

// sql connect
require_once __DIR__ . '/sql/sql_connect.php';

// check auth
require_once __DIR__  . '/blocks/check_auth.php';

$title = 'Главная';

// head
require_once __DIR__ . '/blocks/head.php';

?>

<body>
    <?php

    // header
    require_once __DIR__ . '/blocks/header.php';

    // mobile menu
    require_once __DIR__ . '/blocks/menu.php';

    // select emporiums
    require_once __DIR__ . '/sql/select_emporiums.php';

    ?>

    <main class="main">
        <div class="container">
            <div class="main-content">
                
                <?php

                // nav
                require_once __DIR__ . '/blocks/nav.php';

                ?>

                <div class="main-content__centers">
                    <h2 class="main-content__title">Корпуса</h2>
                    <div class="shopping-centers">

                        <?php foreach($emporiums as $emporium): ?>

                        <div class="shopping-center">
                            <div class="shopping-center__img">
                                <img src="./images/shopping-centers/<?=$emporium->img;?>" alt="<?=$emporium->name;?>">
                            </div>
                            <div class="shopping-center__content">
                                <h3 class="shopping-center__title js-shopping-center-title"><?=$emporium->name;?></h3>
                                <p class="shopping-center__descr"><?=$emporium->description;?></p>
                                <button
                                    class="shopping-center__btn js-shopping-center"
                                    data-id="<?=$emporium->id;?>"
                                    data-floors="<?=$emporium->number_floors;?>">
                                    Открыть
                                    <img src="./icons/arrow-right.svg" alt="arrow-right">
                                </button>
                            </div>
                        </div>

                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="modal js-modal">
                    <div class="modal-content-floor js-modal-floor">
                        <h2 class="modal-title js-modal-title"></h2>
                        <div class="modal-close js-modal-close">×</div>

                        <h3 class="modal-select__title">Выберите этаж:</h3>
                        <select class="modal-select js-floors-select" data-id=""></select>
                        <h2 class="modal-title">Точки питания</h2>
                        <div class="food-points js-food-points"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php

    // footer
    require_once __DIR__ . '/blocks/footer.php';
    
    ?>
    
    <script src="./includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>