<?php

const DB_NAME = 'mtk_course';
const DB_USER = 'root';
const DB_HOST = 'localhost';
const DB_PASSWORD = '';
try {

  $conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

  $qry = 'select * from users';
  $pdo = $conn->query($qry);
  $users = $pdo->fetchAll(PDO::FETCH_OBJ);
  foreach ($users as $user) {
    echo $user->name.'<br>';
  }


}catch(Exception $e) {
  echo $e->getMessage();
}