<?php
session_start();
$_SESSION['like']++;
if(isset($_SESSION['like'])){
  echo $_SESSION['like'];
}