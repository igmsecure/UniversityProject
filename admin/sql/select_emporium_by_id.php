<?php

$sql = 'SELECT * FROM `emporiums` WHERE `id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$emporium = $query->fetch(PDO::FETCH_OBJ);
