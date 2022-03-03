<?php

$sql = 'SELECT * FROM `points` WHERE `emporium_id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$points = $query->fetchAll(PDO::FETCH_OBJ);
