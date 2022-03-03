<?php

$sql = 'SELECT `id`, `name`, `img`, `address` FROM `points` WHERE `emporium_id` = :id AND `floor` = :floor ORDER BY `id`';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id, 'floor' => $floor]);
$points = $query->fetchAll(PDO::FETCH_OBJ);
