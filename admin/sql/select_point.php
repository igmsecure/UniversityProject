<?php

$sql = 'SELECT * FROM `points` WHERE `id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$point = $query->fetch(PDO::FETCH_OBJ);
