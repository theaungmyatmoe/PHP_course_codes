<?php
require_once 'inc/header.php';

if(isset($_GET['user'])){
  if(!empty($_GET['user'])){
  $user = $_GET['user'];
 $user = User::profile($user);
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $id = $user->id;
  User::update($_POST,$id);
}
?>


<div class="card card-dark my-3">
  <div class="card-header bg-warning">
    <h3>Edit Account</h3>
  </div>
  <div class="card-body">
     <div>
      <img class="w-50 h-50"src="<?php echo 'assets/users/'.$user->profile_img; ?>">
    </div>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="" class="text-white">Rename Username</label>
        <input type="name" class="form-control"
        placeholder="enter username" name="name" value="<?php echo $user->name;  ?>">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Rename Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Choose Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <input type="submit" value="Update"
      class="btn  btn-outline-warning" autocomplete="off">
    </form>
  </div>
</div>
<?php
require_once 'inc/footer.php';

?>