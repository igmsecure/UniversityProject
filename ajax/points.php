<?php

//sql connect
require_once __DIR__ . '/../sql/sql_connect.php';

$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
$floor = trim(filter_var($_POST['floor'], FILTER_SANITIZE_STRING));

//select points by floor
require_once __DIR__ . '/../sql/select_points.php';

echo json_encode($points);
