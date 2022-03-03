<?php

if (!isset($_GET['emp']) || !is_numeric($_GET['emp'])) {
    header('Location: index.php');
}

if (!isset($_GET['point']) || !is_numeric($_GET['point'])) {
    header('Location: index.php');
}

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Редактирование точки питания';
$id = $_GET['emp'];
$pointId = $_GET['point'];

// sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

// select emporium
require_once __DIR__ . '/sql/select_emporium_by_id.php';

if (!is_object($emporium)) {
    header('Location: index.php');
}

// select point by id and emporium id
require_once __DIR__ . '/sql/select_point_by_id.php';

if (!is_object($point)) {
    header('Location: index.php');
}

if (isset($_POST['edit_point'])) {

    $imgName = $point->img;

    if (isset($_FILES['image'])) {

        require_once __DIR__ . '/functions.php';

        $imgName = makeUpload($_FILES['image'], 'food-points', $imgName);

        if ($imgName !== $point->img && $point->img !== 'default.png') {
            unlink(__DIR__ . '/../images/food-points/' . $point->img);
        }
    }
    
    // edit point
    require_once __DIR__ . '/sql/edit_point.php';

    header('Location: index.php');
}

// select products
require_once __DIR__ . '/sql/select_products_by_point_id.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title><?=$title;?></title>
</head>

<body>
    <?php

    // header
    require_once __DIR__ . '/../blocks/header.php';

    ?>

    <main class="admin-main">
        <div class="container">
            <h2 class="admin-title"><?=$title;?></h2>
            <form action="" method="POST" class="edit-point__form" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Название" value="<?=$point->name?>" required>
                <textarea placeholder="Адрес" name="address" required><?=$point->address?></textarea>
                <label for="image">
                    <h3>Выберите изображение (svg/png/jpg/jpeg):</h3>
                    <input type="file" name="image" id="image" accept="image/*">
                </label>
                <select name="floor">

                <?php for ($i = 1; $i <= $emporium->number_floors; $i++): ?>
                
                <?php if ($i == $point->floor): ?>

                <option selected value="<?=$i?>"><?=$i?>-й этаж</option>

                <?php else: ?>

                <option value="<?=$i?>"><?=$i?>-й этаж</option>

                <?php endif; ?>

                <?php endfor; ?>

                </select>

                <h3>Часы работы:</h3>
                <label for="from" class="time-label">
                    <h5>От:</h5>
                    <input type="time" name="time_from" value="<?=$point->work_time_from?>" id="from" required>
                </label>
                <label for="to" class="time-label">
                    <h5>До:</h5>
                    <input type="time" name="time_to" id="to" value="<?=$point->work_time_to?>" required>
                </label>

                <button type="submit" name="edit_point">Сохранить</button>
            </form>
            <hr>
            <h2 class="admin-title">Список продуктов для этой точки</h2>
            <a href="add_product.php?point=<?=$pointId?>" class="admin-product__create">Добавить</a>

            <div class="admin-products">

            <?php foreach($products as $product): ?>

                <div class="admin-product" data-id="<?=$product->id;?>">
                    <header class="admin-product__header">
                        <img src="../images/products/<?=$product->img;?>" alt="<?=$product->name;?>">
                        <h4><?=$product->name;?></h4>
                    </header>
                    <div class="admin-product__btns">
                        <div class="aviable">
                            <h6>В наличии</h6>
                            <label class="switch">
                                <input type="checkbox" class="js-aviable-checkbox" <?=$product->status == 1 ? 'checked' : '';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <a href="edit_product.php?point=<?=$pointId;?>&prod=<?=$product->id;?>" class="admin-product__btn edit">Редактировать</a>
                        <button class="admin-product__btn delete js-delete-product">Удалить</button>
                    </div>
                </div>

            <?php endforeach; ?>

            </div>
        </div>
    </main>

    <script src="../includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
