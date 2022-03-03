<?php

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Корпуса';

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

    // select emporiums
    require_once __DIR__ . '/../sql/select_emporiums.php';

    ?>

    <main class="admin-main">
        <div class="container">
            <a href="categories.php" class="admin-categories__link">Категории</a>

            <h2 class="admin-title"><?=$title;?></h2>
            <a href="add_emporium.php" class="admin-emporium__create">Добавить</a>
            <div class="admin-emporiums">

            <?php foreach($emporiums as $emporium): ?>

                <div class="admin-emporium" data-id="<?=$emporium->id;?>">
                    <header class="admin-emporium__header">
                        <img src="../images/shopping-centers/<?=$emporium->img;?>" alt="<?=$emporium->name;?>">
                        <h4><?=$emporium->name;?></h4>
                    </header>
                    <div class="admin-emporium__btns">
                        <a href="edit_emporium.php?emp=<?=$emporium->id;?>" class="admin-emporium__btn edit">Редактировать</a>
                        <button class="admin-emporium__btn delete js-delete-emporium">Удалить</button>
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
