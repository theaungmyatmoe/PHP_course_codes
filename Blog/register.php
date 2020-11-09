<?php
require_once 'inc/header.php';
?>

<?php
//  Check User Auth
if(User::auth()){
  Helper::redirect('index');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = new User();
  $register = $user->register($_POST);
  if($register == "success"){
    Helper::redirect('index');
  }
}
?>
<div class="card card-dark my-3">
  <div class="card-header bg-warning">
    <h3>Register Account</h3>
  </div>
  <div class="card-body">
    <?php
    // Validation
    if (is_array($register)) {
      foreach ($register as $error){
    ?>
    <div class="alert alert-danger">
    <?php
    echo $error;
    ?>
    </div>
    <?php
    }
    }
    ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="" class="text-white">Enter Username</label>
        <input type="name" class="form-control"
        placeholder="enter username" name="name">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Enter Email</label>
        <input type="email" class="form-control"
        placeholder="enter email" name="email">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Enter Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <input type="submit" value="Register"
      class="btn  btn-outline-warning" autocomplete="off">
    </form>
  </div>
</div>
<?php
require_once 'inc/footer.php';

?>