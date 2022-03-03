<?php

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Добавление Корпуса';

if (isset($_POST['add_emporium'])) {
    $imgName = 'default.png';

    if (isset($_FILES['image'])) {

        require_once __DIR__ . '/functions.php';

        $imgName = makeUpload($_FILES['image'], 'shopping-centers', 'default.png');
    }

    // add emporium
    require_once __DIR__ . '/sql/add_emporium.php';

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
            <form action="" method="POST" class="add-emporium__form" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Название" required>
                <textarea placeholder="Описание" name="descr" required></textarea>
                <label for="image">
                    <h3>Выберите изображение (svg/png/jpg/jpeg):</h3>
                    <input type="file" name="image" id="image" accept="image/*">
                </label>
                <label for="floors">
                    <h3>Колличество этажей:</h3>
                    <input type="number" name="floors" id="floors" min="1" value="1">
                </label>
                <button type="submit" name="add_emporium">Добавить</button>
            </form>
        </div>
    </main>

    <script src="../includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
