<?php
require_once 'db.php';

$qry = "insert into users (name,age,location) values ('Aung Aung',20,'Japn')";
$stm = $conn->prepare($qry);
echo $stm->execute() ?? 'Fail';