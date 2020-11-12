<?php
require_once 'inc/header.php';

if (isset($_GET['category'])) {
  $slug = $_GET['category'];
  $posts = Post::catBySlug($slug);
} elseif (isset($_GET['language'])) {
  $slug = $_GET['language'];
  $posts = Post::langBySlug($slug);
} elseif (isset($_GET['search'])) {
  $search = $_GET['search'];
  $posts = Post::search($search);
} else {
  $posts = Post::all();
}
// Edit And delete
if (isset($_GET['delete'])) {
  Post::delete($_GET['delete']);
}
if (isset($_GET['edit'])) {
  Post::edit($_GET['edit']);
}
if (isset($_GET['owner'])) {
  $user = DB::table('users')->where('slug', $_GET['owner'])->getOne();
  if ($user) {
    $posts = Post::ownerPost($user->slug);
  } else {
    Helper::redirect('404');
  }
}
?>

<!-- Pagination  -->
<div class="card card-dark">
  <div class="card-body">
    <a href="<?php echo $posts['prev_page']; ?>" class="btn btn-danger">Prev Posts</a>
    <a href="<?php echo $posts['next_page']; ?>" class="btn btn-danger float-right">Next Posts</a>
  </div>
</div>
<!-- Post  -->
<div class="card card-dark">
  <div class="card-body">
    <div class="row">
      <!-- Loop this -->
      <?php foreach ($posts['data'] as $post): ?>
      <div class="col-md-4 mt-2" style="height:400px">
        <div class="card">
          <img class="img-fluid"
          src="<?php echo 'assets/imgs/'.$post->img; ?>" style="height:200px"
          >
          <div class="card-body">
            <h5 class="text-dark"><?php
              echo $post->title;
              ?></h5>
          </div>
          <div class="card-footer">
            <div class="row">
              <div
                class="col-md-4 text-center">
                <button id="like"
                  class="btn fas fa-heart text-warning" userId="<? echo User::auth()->id; ?>" articleId="<? echo $post->id; ?>">
                </button>
                <small
                  class="text-muted" id="showCount"><?php
                  echo $post->like_counts;
                  ?></small>
              </div>
              <div
                class="col-md-4 text-center">
                <i
                  class="far fa-comment text-dark"></i>
                <small
                  class="text-muted"><?php
                  echo $post->comment_counts;
                  ?></small>
              </div>
              <div
                class="col-md-4 text-center">
                <a href="detail.php?slug=<?php echo $post->slug; ?>"
                  class="badge badge-warning p-1">View</a>
                <!-- Edit  and Delete Access To Owner -->
                <?php if (User::auth()): ?>
                <a href="edit.php?edit=<?php echo $post->slug; ?>"
                  class="badge badge-info p-1">Edit</a>
                <a href="index.php?delete=<?php echo $post->slug; ?>"
                  class="badge badge-danger p-1">Delete</a>
                <?php endif; ?>
              </div>
            </div>

          </div>
        </div>

      </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>
<?php
require_once 'inc/footer.php';

?>
