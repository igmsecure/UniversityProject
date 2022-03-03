<?php

$sql = 'SELECT * FROM `categories` WHERE `id` = :id';
$query = mysqlConnect()->prepare($sql);
$query->execute(['id' => $id]);
$category = $query->fetch(PDO::FETCH_OBJ);
