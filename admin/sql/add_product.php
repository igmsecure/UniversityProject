<?php

$sql = 'INSERT INTO products(point_id, name, price, img, category_id) VALUES(?, ?, ?, ?, ?)';
$query = mysqlConnect()->prepare($sql);
$query->execute([$id, $_POST['name'], $_POST['price'], $imgName, $_POST['category']]);
$product = $query->fetch(PDO::FETCH_OBJ);
