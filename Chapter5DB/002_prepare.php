<?php

const DB_NAME = 'mtk_course';
const DB_USER = 'root';
const DB_HOST = 'localhost';
const DB_PASSWORD = '';

$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

$id = $_GET['id'];
$stm = $conn->prepare('select * from users where id=?');
$stm->execute([$id]);
$res = $stm->fetch(PDO::FETCH_OBJ);
print_r($res);