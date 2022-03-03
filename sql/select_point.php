<?php

$sql = 'SELECT `id`, `name`, `address`, `work_time_from`, `work_time_to` FROM `points` WHERE `id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$point = $query->fetch(PDO::FETCH_OBJ);
