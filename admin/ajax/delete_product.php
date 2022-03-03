<?php

require_once __DIR__ . '/../check_auth.php';

//sql connect
require_once __DIR__ . '/../../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));

//select product by id
require_once __DIR__ . '/../sql/select_product.php';

if (is_object($product) && $product->id > 0) {
    if ($product->img != 'default.png') {
        unlink(__DIR__ . '/../../images/products/' . $product->img);
    }
}

// delete product
require_once __DIR__ . '/../sql/delete_product.php';

echo 'Ok';
