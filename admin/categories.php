<?php

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Категории';

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

    // select categories
    require_once __DIR__ . '/../sql/select_categories.php';

    ?>

    <main class="admin-main">
        <div class="container">

            <h2 class="admin-title"><?=$title;?></h2>
            <a href="add_category.php" class="admin-category__create">Добавить</a>
            <div class="admin-categories">

            <?php foreach($categories as $category): ?>

                <div class="admin-category" data-id="<?=$category->id;?>">
                    <h4><?=$category->name;?></h4>
                    <div class="admin-category__btns">
                        <a href="edit_category.php?id=<?=$category->id;?>" class="admin-category__btn edit">Редактировать</a>
                        <button class="admin-category__btn delete js-delete-category">Удалить</button>
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