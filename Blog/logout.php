<?php
require_once 'core/autoload.php';
if(isset($_SESSION['user_id'])){
  session_destroy();
  Helper::redirect('login');
}