<?php

$sql = 'SELECT `id`, `img` FROM `points` WHERE `emporium_id` = :id && `floor` = :floor';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id, 'floor' => $i]);
$points = $query->fetchAll(PDO::FETCH_OBJ);
