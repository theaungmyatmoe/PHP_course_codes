<?php

class Papa{
  const NAME = 'localhost';
}
class Son{
  public function getName(){
    echo Papa::NAME;
  }
}
$obj = new Son();
$obj->getName();