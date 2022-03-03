<?php

$sql = 'UPDATE emporiums SET name = ?, description = ?, img = ?, number_floors = ? WHERE `id` = ?';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['name'], $_POST['descr'], $imgName, $_POST['floors'], $id]);
$emporium = $query->fetch(PDO::FETCH_OBJ);
