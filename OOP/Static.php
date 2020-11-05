<?php

class Test{
  public static $name = "amm";
  public static function getName(){
    echo self::$name;
  }
}
Test::getName();