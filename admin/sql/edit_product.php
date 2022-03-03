<?php

$sql = 'UPDATE products SET name = ?, price = ?, img = ?, category_id = ? WHERE `id` = ?';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['name'], $_POST['price'], $imgName, $_POST['category'], $productId]);
$product = $query->fetch(PDO::FETCH_OBJ);
