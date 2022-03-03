<?php

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Добавление категории';

if (isset($_POST['add_category'])) {

    // add category
    require_once __DIR__ . '/sql/add_category.php';

    header('Location: categories.php');
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
            <form action="" method="POST" class="add-category__form">
                <input type="text" name="name" placeholder="Название" required>
                <button type="submit" name="add_category">Добавить</button>
            </form>
        </div>
    </main>

    <script src="../includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
