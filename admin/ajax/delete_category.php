<?php

require_once __DIR__ . '/../check_auth.php';

//sql connect
require_once __DIR__ . '/../../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));

// delete category
require_once __DIR__ . '/../sql/delete_category.php';

echo 'Ok';
