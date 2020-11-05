<?php
class Child{
  private $name,$age;
  function getName($name){
    $this->name = $name;
  return $this;
  }
  function getAge($age){
    $this->age = $age;
    return $this;
  }
  function getDetails(){
    echo $this->name.$this->age;
  }
}
$obj = new Child();
$obj->getName('Amm')->getAge(17)->getDetails();
// $obj->getName('Amm');
// $obj->getAge(18);
// $obj->getDetails();