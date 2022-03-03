<?php

$sql = 'SELECT `id`, `login`, `role` FROM `users` WHERE `hash` = :hash';
$query = mysqlConnect()->prepare($sql);
$query->execute(['hash' => $hash]);
$user = $query->fetch(PDO::FETCH_OBJ);
