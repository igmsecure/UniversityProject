<?php

if (!isset($_GET['point']) || !is_numeric($_GET['point'])) {
    header('Location: index.php');
}

$id = $_GET['point'];

// sql connect
require_once __DIR__ . '/sql/sql_connect.php';

// check auth
require_once __DIR__  . '/blocks/check_auth.php';

// select food point
require_once __DIR__ . '/sql/select_point.php';

if (!is_object($point)) {
    header('Location: index.php');
}

// select categories
require_once __DIR__ . '/sql/select_categories.php';

$title = 'Меню';

// head
require_once __DIR__ . '/blocks/head.php';

?>

<body>
    <?php

    // header
    require_once __DIR__ . '/blocks/header.php';

    // select products
    require_once __DIR__ . '/sql/select_products.php';

    ?>

    <main class="main">
        <div class="container">
            <div class="main-content">

                <?php

                // nav
                require_once __DIR__ . '/blocks/nav.php';

                ?>

                <div class="main-content__products">
                    <div class="main-content__title">
                        <?=$point->name?>
                    </div>
                    <p class="main-content__time">
                        Часы работы: c <span><?=$point->work_time_from?></span> до <span><?=$point->work_time_to?></span>
                    </p>
                    <p class="main-content__address">
                        Адрес: <?=$point->address?>
                    </p>
                    <h4 class="main-menu__title">
                        Меню
                    </h4>
                    <div class="products">

                    <?php foreach($categories as $category):

                        $titleCount = 0;

                        foreach($products as $product): ?>

                        <?php if ($product->category_id == $category->id): 
                                if ($titleCount == 0) {
                                    echo "<h6 class='main-category__title'>{$category->name}</h6>";
                                    $titleCount++;
                                }
                                ?>
                                <div class="product-item">
                                    <div class="product-item__img">
                                        <img src="./images/products/<?=$product->img?>" alt="<?=$product->name?>">
                                    </div>
                                    <div class="product-item__text">
                                        <h5 class="product-item__title"><?=$product->name?></h5>
                                        <h6 class="aviable-title"><?=$product->status == 0 ? 'Нет в наличии' : 'В наличии'?></h6>
                                    </div>
                                    <span class="product-item__price"><?=$product->price?> руб.</span>
                                </div>
                        <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php

    // footer
    require_once __DIR__ . '/blocks/footer.php';

    ?>

</body>
</html>