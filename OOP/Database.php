<?php
/**
 * Database Class
 */
class Database
{
  
  private $host = 'localhost';
  
  public function connection()
  {
    return $this->host;
  }
  public function all($val = 'users'){
    return $val;
  }
}      
class User extends Database{
  function getDetails(){
    return $this->connection();
  }
}
$conn = new User();
echo $conn->getDetails();