<?php

abstract class Building{
  public $name = 'SweetHome';
  abstract function getName();
}
class Secbuilding extends Building{
  function getName(){
    echo 'I am.abstrct!';
  }
}
$obj = new Secbuilding();
$obj->getName();