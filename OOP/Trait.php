<?php

trait Father{
  public $fname = 'U Maung Shwe';
}
trait Mom{
  public $mname = 'Daw Than Than Swe';
}
trait Parents{
  use Father,Mom;
}
class Son{
  use Parents;
  function __construct(){
    echo $this->fname;
    echo $this->mname;
  }
}
new Son();