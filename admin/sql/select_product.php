<?php

$sql = 'SELECT `id`, `img` FROM `products` WHERE `id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$product = $query->fetch(PDO::FETCH_OBJ);
