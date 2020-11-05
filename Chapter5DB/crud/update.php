<?php
require_once 'asset/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $img = $_FILES['image'];
    $hiddenImgName = $_POST['hidden'];
    //check img exist or not
    if (!empty($img['name'])) {
      $imgName = rand().'_'.$img['name'];
      //move file
      move_uploaded_file($img['tmp_name'],'images/'.$imgName);
    } else {
      $imgName = $hiddenImgName;
    }
    //update to db
    $qry = 'update crud set name=?,image=? where id=?';
    $stm = $conn->prepare($qry);
   $updated = $stm->execute([$name,$imgName,$id]);
   if($updated){
     header('Location:index.php');
   }
  }
}
?>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Edit User
    </div>
    <div class="card-body">
      <a href="index.php" class="btn btn-dark text-light my-3">Back</a>
      <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $stm = $conn->prepare('select * from crud where id=?');
          $stm->execute([$id]);
          $user = $stm->fetch(PDO::FETCH_OBJ);
        }
        ?>
        <img src="images/<?php echo $user->image; ?>" alt="Nothing" class="img-fluid">
        <div class="form-group mb-3">
          <label>Name</label><br>
          <input type="text" class="form-control" name="name" value="<? echo $user->name; ?>">
        </div>
        <div class="form-group mb-3">
          <label>Choose Image</label><br>
          <input type="file" class="form-control" name="image">
          <input type="hidden" class="form-control" name="hidden" value="<? echo $user->image; ?>">
        </div>
        <input type="submit" name="update" class="btn btn-success my-3" value="Edit">
      </form>
    </div>
  </div>
</div>

<?php require_once 'asset/footer.php' ?>