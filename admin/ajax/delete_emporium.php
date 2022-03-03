<?php

require_once __DIR__ . '/../check_auth.php';

//sql connect
require_once __DIR__ . '/../../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));

//select emporium by id
require_once __DIR__ . '/../sql/select_emporium_by_id.php';

if (is_object($emporium) && $emporium->img != 'default.png') {
    unlink(__DIR__ . '/../../images/shopping-centers/' . $emporium->img);
} 

//select points by emporium_id
require_once __DIR__ . '/../sql/select_points_by_emporium_id.php';

foreach ($points as $point) {
    if ($point->img != 'default.png') {
        unlink(__DIR__ . '/../../images/food-points/' . $point->img);
    }

    //select products by point_id
    require __DIR__ . '/../sql/select_products_by_point_id.php';

    foreach ($products as $product) {
        if ($product->img != 'default.png') {
            unlink(__DIR__ . '/../../images/products/' . $product->img);
        }
    }
}

// delete emporium
require_once __DIR__ . '/../sql/delete_emporium.php';

echo 'Ok';
