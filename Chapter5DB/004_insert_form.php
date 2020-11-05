<?php

const DB_NAME = 'mtk_course';
const DB_USER = 'root';
const DB_HOST = 'localhost';
const DB_PASSWORD = '';
$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $age = $_POST['age'];
  $location = $_POST['location'];
  $stm = $conn->prepare("insert into users (name,age,location) values (?,?,?)");
  $result = $stm->execute([$name, $age, $location]);
  echo $result ? 'Success' : die('Fail To Create');
   }

}

?>

<form action="" method="post">
  <div>
    <input type="text" name="name" placeholder="Type Your Name">
  </div>
  <div>
    <input type="number" name="age" placeholder="Type Your Age">
  </div>
  <div>
    <input type="text" name="location" placeholder="Type Your Locatiin">
  </div>
  <button type="submit" name="submit">Create</button>
</form>