<?php

require_once __DIR__ . '/../check_auth.php';

// sql connect
require_once __DIR__ . '/../../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));

// change product status
require_once __DIR__ . '/../sql/change_product_status.php';

echo 'Ok';