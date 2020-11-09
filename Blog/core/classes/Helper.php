<?php

/**
 * Helper Functions
 */
class Helper
{
  
  public static function redirect($fileName)
  {
    header("Location:{$fileName}.php");
  }
  static function strFilter($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
  }
}