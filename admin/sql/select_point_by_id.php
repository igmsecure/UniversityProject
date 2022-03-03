<?php

$sql = 'SELECT * FROM `points` WHERE `id` = :id AND `emporium_id` = :emporium_id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $pointId, 'emporium_id' => $id]);
$point = $query->fetch(PDO::FETCH_OBJ);
