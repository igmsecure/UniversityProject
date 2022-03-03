<?php

if (!isset($_GET['point']) || !is_numeric($_GET['point'])) {
    header('Location: index.php');
}

if (!isset($_GET['prod']) || !is_numeric($_GET['prod'])) {
    header('Location: index.php');
}

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Редактирование продукта';
$id = $_GET['point'];
$productId = $_GET['prod'];

// sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

// select point
require_once __DIR__ . '/sql/select_point.php';

if (!is_object($point)) {
    header('Location: index.php');
}

// select product by id and point id
require_once __DIR__ . '/sql/select_product_by_id.php';

if (!is_object($product)) {
    header('Location: index.php');
}

// select categories
require_once __DIR__ . '/../sql/select_categories.php';

if (isset($_POST['edit_product'])) {

    $imgName = $product->img;

    if (isset($_FILES['image'])) {

        require_once __DIR__ . '/functions.php';

        $imgName = makeUpload($_FILES['image'], 'products', $imgName);

        if ($imgName !== $product->img && $product->img !== 'default.png') {
            unlink(__DIR__ . '/../images/products/' . $product->img);
        }
    }

    // edit product
    require_once __DIR__ . '/sql/edit_product.php';

    header('Location: index.php');
}

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
            <form action="" method="POST" class="edit-product__form" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Название" value="<?=$product->name?>" required>
                <label for="image">
                    <h3>Выберите изображение (svg/png/jpg/jpeg):</h3>
                    <input type="file" name="image" id="image" accept="image/*">
                </label>
                <label for="price">
                    <h3>Цена (в рублях):</h3>
                    <input type="number" name="price" id="price" min="1" value="<?=$product->price?>">
                </label>

                <select name="category">

                <?php foreach ($categories as $category): ?>
                
                <?php if ($category->id == $product->category_id): ?>

                <option selected value="<?=$category->id?>"><?=$category->name?></option>

                <?php else: ?>

                <option value="<?=$category->id?>"><?=$category->name?></option>

                <?php endif; ?>

                <?php endforeach; ?>

                </select>

                <button type="submit" name="edit_product">Сохранить</button>
            </form>
        </div>
    </main>

    <script src="../includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
