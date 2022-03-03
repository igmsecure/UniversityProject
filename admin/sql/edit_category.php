<?php

$sql = 'UPDATE categories SET name = ? WHERE `id` = ?';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['name'], $id]);
$category = $query->fetch(PDO::FETCH_OBJ);
