<?php
require_once 'inc/header.php';
$slug = $_GET['slug'];
if (empty($slug)) {
  Helper::redirect('404');
} else {
  $post = Post::detail($slug);
  $cat = Post::category($post->category_id);
}
?>

<div class="jumbotron jumbotron-fluid header">
  <div class="container">
    <h1 class="text-white">MM-Coder Online Course</h1>
    <h1 class="display-4 text-white">Welcome Com From Advance PHP Online Class</h1>
    <p class="lead text-white">
      Hello Now We publish this course free.
    </p>
    <br>
    <a href="" class="btn btn-warning">Create Account</a>
    <a href="" class="btn btn-outline-success">Login</a>
  </div>
</div>

<!-- Content -->
<div class="container-fluid">
  <div class="row">

    <!-- Content -->
    <div class="col-md-8">

      <div class="card card-dark">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-dark">
                <div class="card-body">
                  <div class="row">
                    <!-- icons -->
                    <div class="col-md-4">
                      <div class="row">
                        <div
                          class="col-md-4 text-center">
                          <i
                            class="fas fa-heart text-warning">
                          </i>
                          <small
                            class="text-muted"><?php
                            echo $post->like_counts; ?></small>
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

                      </div>
                    </div>
                    <!-- Icons -->

                    <!-- Category -->
                    <div class="col-md-4">
                      <div class="row">
                        <div
                          class="col-md-12">
                          <a href=""
                            class="badge badge-primary"><?php
                            echo $cat->name;
                            ?></a>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="col-md-12">
            <h3><?php
              echo $post->title;
              ?></h3>
            <p>
              <?php
              echo $post->content;
              ?>
            </p>
          </div>

          <!-- Comments -->
          <div class="card card-dark">
            <div class="card-header">
              <h4>Comments</h4>
            </div>
            <div class="card-body">
              <!-- Loop Comment -->
              <?php
              $cmts = Post::comments($post->id);
              ?>
              <?php foreach ($cmts as $cmt): ?>
              <div class="card-dark mt-1">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      <img src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg"
                      style="width:50px;border-radius:50%"
                      alt="">
                    </div>
                    <div
                      class="col-md-4 d-flex align-items-center">
                      <?
                      $users = Post::user($cmt->user_id);
                      foreach ($users as $user) {

                        echo $user->name;
                      }
                      ?>
                    </div>
                  </div>
                  <hr>
                  <p>
                    <?php
                    echo $cmt->content;
                    ?>
                  </p>
                </div>
              </div>
              <?php  endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



</div>

<script>
  $(document).ready(function () {
    $('body').bootstrapMaterialDesign();
  });
</script>
<?php
require_once 'inc/footer.php';

?>