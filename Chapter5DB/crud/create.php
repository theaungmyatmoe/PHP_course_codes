<?php require_once 'asset/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $img = $_FILES['image'];
    $imgName = $img['name'];
    //  Move file
    move_uploaded_file($img['tmp_name'], 'images/'.$imgName);
    //insert to db
    $stm = $conn->prepare("insert into crud (name,image) values (?,?)");
    $result = $stm->execute([$name, $imgName]);
    if ($result) {
      header('Location:index.php?result=success');
    }

  }
}

?>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Crete User
    </div>
    <div class="card-body">
      <a href="index.php" class="btn btn-dark text-light my-3">Back</a>
      <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
          <label>Name</label><br>
          <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group mb-3">
          <label>Choose Image</label><br>
          <input type="file" class="form-control" name="image">
        </div>
        <input type="submit" name="create" class="btn btn-success my-3">
      </form>
    </div>
  </div>
</div>

<?php require_once 'asset/footer.php' ?>