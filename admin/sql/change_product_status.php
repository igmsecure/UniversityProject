<?php

$sql = 'UPDATE products SET status = ? WHERE `id` = ?';
$query = mysqlConnect()->prepare($sql);
$query->execute([$status, $id]);
$product = $query->fetch(PDO::FETCH_OBJ);