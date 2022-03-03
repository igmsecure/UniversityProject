<?php

$sql = 'SELECT `name`, `price`, `img`, `status`, `category_id` FROM `products` WHERE `point_id` = :id ORDER BY `id`';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$products = $query->fetchAll(PDO::FETCH_OBJ);
