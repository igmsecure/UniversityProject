<?php

$sql = 'UPDATE points SET floor = ?, name = ?, address = ?, img = ?, work_time_from = ?, work_time_to = ? WHERE `id` = ?';
$query = mysqlConnect()->prepare($sql);
$query->execute([$_POST['floor'], $_POST['name'], $_POST['address'], $imgName, $_POST['time_from'], $_POST['time_to'], $pointId]);
$point = $query->fetch(PDO::FETCH_OBJ);
