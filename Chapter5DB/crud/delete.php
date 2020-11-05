<?php

require_once 'asset/header.php';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $stm = $conn->prepare('delete from crud where id=?');
  $stm->execute([$id]);
  header('Location:index.php?delete=success');
}

?>