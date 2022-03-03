<?php

$sql = 'SELECT * FROM `products` WHERE `point_id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $point->id]);
$products = $query->fetchAll(PDO::FETCH_OBJ);
