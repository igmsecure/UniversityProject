<?php

if (!isset($_GET['emp']) || !is_numeric($_GET['emp'])) {
    header('Location: index.php');
}

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Редактирование Корпуса';
$id = $_GET['emp'];

// sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

// select emporium
require_once __DIR__ . '/sql/select_emporium_by_id.php';

if (!is_object($emporium)) {
    header('Location: index.php');
}

if (isset($_POST['edit_emporium'])) {

    $imgName = $emporium->img;

    if (isset($_FILES['image'])) {

        require_once __DIR__ . '/functions.php';

        $imgName = makeUpload($_FILES['image'], 'shopping-centers', $imgName);

        if ($imgName !== $emporium->img && $emporium->img !== 'default.png') {
            unlink(__DIR__ . '/../images/shopping-centers/' . $emporium->img);
        }
    }

    if ($_POST['floors'] < $emporium->number_floors) {
        for ($i = $emporium->number_floors; $i > $_POST['floors']; $i--) { 
            
            // select points by emporium_id and floor
            require_once __DIR__ . '/sql/select_point_by_emporium_floor.php';

            foreach ($points as $point) {
                if ($point->img != 'default.png') {
                    unlink(__DIR__ . '/../../images/food-points/' . $point->img);
                }

                // select products by point_id
                require __DIR__ . '/sql/select_products_by_point_id.php';

                foreach ($products as $product) {
                    if ($product->img != 'default.png') {
                        unlink(__DIR__ . '/../../images/products/' . $product->img);
                    }
                }

                $id = $point->id;

                // delete point
                require __DIR__ . '/sql/delete_point.php';
            }
        }
    }

    // edit emporium
    require_once __DIR__ . '/sql/edit_emporium.php';

    header('Location: index.php');
}

// select points
require_once __DIR__ . '/sql/select_points_by_emporium_id.php';

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
            <form action="" method="POST" class="edit-emporium__form" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Название" value="<?=$emporium->name?>" required>
                <textarea placeholder="Описание" name="descr" required><?=$emporium->description?></textarea>
                <label for="image">
                    <h3>Выберите изображение (svg/png/jpg/jpeg):</h3>
                    <input type="file" name="image" id="image" accept="image/*">
                </label>
                <label for="floors">
                    <h3>Колличество этажей:</h3>
                    <input type="number" name="floors" id="floors" min="1" value="<?=$emporium->number_floors?>">
                </label>
                <button type="submit" name="edit_emporium">Сохранить</button>
            </form>
            <hr>
            <h2 class="admin-title">Список пунтков питания для этого корпуса</h2>
            <a href="add_point.php?emp=<?=$id?>" class="admin-point__create">Добавить</a>

            <div class="admin-points">

            <?php foreach($points as $point): ?>

                <div class="admin-point" data-id="<?=$point->id;?>">
                    <header class="admin-point__header">
                        <img src="../images/food-points/<?=$point->img;?>" alt="<?=$point->name;?>">
                        <h4><?=$point->name;?></h4>
                    </header>
                    <div class="admin-point__btns">
                        <a href="edit_point.php?emp=<?=$id?>&point=<?=$point->id;?>" class="admin-point__btn edit">Редактировать</a>
                        <button class="admin-point__btn delete js-delete-point">Удалить</button>
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
