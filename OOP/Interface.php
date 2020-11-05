<?php
interface Animal
{
  function makeSonund();
  function getName();
}
class Cat implements Animal{
  public $name = 'Noopsi';
  function getName(){
    echo $this->name;
  }
  function makeSonund(){
    echo 'mew';
  }
}
$cat = new Cat();
$cat->makeSonund();
echo '<hr>';
$cat->getName();