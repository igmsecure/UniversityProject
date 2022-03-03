<?php

$sql = 'INSERT INTO categories(name) VALUES(?)';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['name']]);
$category = $query->fetch(PDO::FETCH_OBJ);
