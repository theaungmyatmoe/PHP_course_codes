<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Index</title>
</head>
<body>
  <?php
  require_once 'autoload.php';
  new User();
  $newers = DB::table('users')->get();
  foreach ($newers as $user){
    echo $user->name.'<br>';
  }
  ?>
</body>
</html>