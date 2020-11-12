<?php
require_once 'inc/header.php';

if(isset($_GET['edit'])){
 $post = Post::edit($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST)) {
    Post::updatePost($_POST,$_GET['edit']);
  }
}
?>
<div class="card card-dark">
  <div class="card-header">
    <h3>Edit Article</h3>
      <img src="<? echo 'assets/imgs/'.$post->img; ?>" style="width:200px;" class="img-fluid">
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="" class="text-white">Enter Title</label>
        <input type="text" class="form-control"
        placeholder="enter title" name="title" value="<? echo $post->title; ?>">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Choose Category</label>
        <select name="category" class="form-control">
          <?php
          $cats = DB::table('categories')->get();
          foreach ($cats as $cat) {
            ?>
            <option value="<?php echo $cat->id; ?>"><?php echo $cat->name;
            ?></option>
            <?php
          }
          ?>
        </select>
      </div>
      <div class="form-check form-check-inline">
        <?php
        $langs = DB::table('languages')->get();
        foreach ($langs as $lang){
        ?>
        <span class="mr-2">
          <input class="form-check-input" type="checkbox"
          name="langs[]" value="<?php echo $lang->id; ?>">
          <label class="form-check-label"
            for="inlineCheckbox1"><?php echo $lang->name; ?></label>
        </span>
      
        <?php
        }
        ?>
      </div>
      <br><br>
      <div class="form-group">
        <label for="">Choose Image</label>
        <input type="file" class="form-control" name="image">
        <input type="hidden" value="<? echo $post->img;  ?>" name="oldImg">
      </div>
      <div class="form-group">
        <label for="" class="text-white">Enter Articles</label>
        <textarea name="content" class="form-control" id=""
          cols="30" rows="10">
          <? echo $post->content; ?>
        </textarea>
      </div>
      <input type="submit" value="Update"
      class="btn  btn-outline-success">
    </form>
  </div>
</div>

<?php
require_once 'inc/footer.php';

?>