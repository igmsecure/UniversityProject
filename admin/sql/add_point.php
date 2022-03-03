<?php

$sql = 'INSERT INTO points(emporium_id, floor, name, address, img, work_time_from, work_time_to) VALUES(?, ?, ?, ?, ?, ?, ?)';
$query = mysqlConnect()->prepare($sql);
$query->execute([$id, $_POST['floor'], $_POST['name'], $_POST['address'], $imgName, $_POST['time_from'], $_POST['time_to']]);
$point = $query->fetch(PDO::FETCH_OBJ);
