<?php
require_once 'asset/header.php';
?>

<div class="container mt-5">
  <?php
  //success create
  if ($_GET['result'] == 'success') {
    ?>
    <div class="alert alert-success">
      Success
    </div>

    <?php
  }
  //delete success
  if ($_GET['delete'] == 'success') {
    ?>
    <div class="alert alert-success">
     Deleted Successfully
    </div>

    <?php
  }
  ?>
  <table class="table">
    <caption class="text-center">CRUD PHP</caption>
    <a href="create.php" class="btn btn-success">Create</a>
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col" colspan="2" class="text-center">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $qry = 'select * from crud';
      $users = $conn->query($qry)->fetchAll(PDO::FETCH_OBJ);
      $no = 1;
      foreach ($users as $user) {
        ?>
        <tr>
          <th scope="row"><? echo $no;$no++ ?></th>
          <td><? echo $user->name; ?></td>
          <td>
            <img src="images/<?php echo $user->image ?>" alt="No Image" class="img-fluid">
          </td>
          <td class="text-center">
            <a href="update.php?id=<?php echo $user->id ?>" class="btn btn-warning mr-2">Edit</a>
            <a href="delete.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
          </td>

        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>

<?php
require_once 'asset/footer.php';
?>