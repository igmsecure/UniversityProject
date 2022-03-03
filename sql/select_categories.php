<?php

$sql = 'SELECT * FROM `categories` ORDER BY `id`';
$query = mysqlConnect()->prepare($sql);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);
