<?php

$sql = 'SELECT * FROM `emporiums` ORDER BY `id`';
$query = mysqlConnect()->prepare($sql);
$query->execute();
$emporiums = $query->fetchAll(PDO::FETCH_OBJ);
