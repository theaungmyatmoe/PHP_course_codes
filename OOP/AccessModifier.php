<?php

class Test{
  public $name= 'Hello Wordl';
  protected function getName(){
   echo $this->name;
  }
}
$obj = new Test();
echo $obj->name;
class Secobdary extends Test{
  function getName(){
  $obj2 = new Test();
  $obj2->getName();
  }
}
$sec = new Secobdary();
$sec->getName();