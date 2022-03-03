<?php

$sql = 'INSERT INTO emporiums(name, description, img, number_floors) VALUES(?, ?, ?, ?)';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['name'], $_POST['descr'], $imgName, $_POST['floors']]);
$emporium = $query->fetch(PDO::FETCH_OBJ);
