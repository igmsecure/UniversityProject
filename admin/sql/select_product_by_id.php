<?php

$sql = 'SELECT * FROM `products` WHERE `id` = :id AND `point_id` = :point_id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $productId, 'point_id' => $id]);
$product = $query->fetch(PDO::FETCH_OBJ);
