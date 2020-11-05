<?php

class Test{
  function __construct(){
    echo  'I am __constructtor!'.'<br>';
  }
  function show(){
    echo  'I am showing something!!'.'<br>';
  }
  function __destruct(){
    echo  'I am __destructtor!'.'<br>';
  }
}
new Test();