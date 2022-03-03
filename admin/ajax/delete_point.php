<?php

require_once __DIR__ . '/../check_auth.php';

//sql connect
require_once __DIR__ . '/../../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));

//select point by id
require_once __DIR__ . '/../sql/select_point.php';

if (is_object($point) && $point->id > 0) {
    if ($point->img != 'default.png') {
        unlink(__DIR__ . '/../../images/food-points/' . $point->img);
    }
}

//select products by point_id
require __DIR__ . '/../sql/select_products_by_point_id.php';

foreach ($products as $product) {
    if ($product->img != 'default.png') {
        unlink(__DIR__ . '/../../images/products/' . $product->img);
    }
}

// delete point
require_once __DIR__ . '/../sql/delete_point.php';

echo 'Ok';
