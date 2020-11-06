<?php

class Database {
  //connection and instance
  private static $conn;
  private static $instance;

  private function __construct() {
    self::$conn = new \PDO("mysql:host=localhost;dbname=mtk_course", "root", "");
  }
  //invoke if class !is exists
  public static function getConnection() {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    // return while class by its instance
    return self::$instance;
  }
  // select all from users
  public function select($tableName) {
    $stmt = self::$conn->prepare("select * from$tableName");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

$conn = Database::getConnection();
$users = $conn->select('users');
foreach ($users as $user) {
  echo $user->name.'<br>';
}
//echo '<pre>'.print_r($users,true).'</pre>';