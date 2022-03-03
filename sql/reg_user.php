<?php

$sql = 'INSERT INTO users(login, email, hash) VALUES(?, ?, ?)';
$query = mysqlConnect()->prepare($sql);
$query->execute([$login, $email, $hash]);
$user = $query->fetch(PDO::FETCH_OBJ);
