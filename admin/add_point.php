<?php

if (!isset($_GET['emp']) || !is_numeric($_GET['emp'])) {
    header('Location: index.php');
}

// check auth
require_once __DIR__ . '/check_auth.php';

$title = 'Добавление точки питания';
$id = $_GET['emp'];

// select emporium
require_once __DIR__ . '/sql/select_emporium_by_id.php';

if (!is_object($emporium)) {
    header('Location: index.php');
}

if (isset($_POST['add_point'])) {
    $imgName = 'default.png';

    if (isset($_FILES['image'])) {

        require_once __DIR__ . '/functions.php';

        $imgName = makeUpload($_FILES['image'], 'food-points', 'default.png');
    }

    // add point
    require_once __DIR__ . '/sql/add_point.php';

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
            <form action="" method="POST" class="add-point__form" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Название" required>
                <textarea placeholder="Адрес" name="address" required></textarea>
                <label for="image">
                    <h3>Выберите изображение (svg/png/jpg/jpeg):</h3>
                    <input type="file" name="image" id="image" accept="image/*">
                </label>
                <select name="floor">

                <?php for ($i = 1; $i <= $emporium->number_floors; $i++): ?>

                <option value="<?=$i?>"><?=$i?>-й этаж</option>

                <?php endfor; ?>

                </select>
                
                <h3>Часы работы:</h3>
                <label for="from" class="time-label">
                    <h5>От:</h5>
                    <input type="time" name="time_from" id="from" required>
                </label>
                <label for="to" class="time-label">
                    <h5>До:</h5>
                    <input type="time" name="time_to" id="to" required>
                </label>

                <button type="submit" name="add_point">Добавить</button>
            </form>
        </div>
    </main>

    <script src="../includes/jquery-3.4.1.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
