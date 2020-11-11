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
                          <?php
                          if (isset($_SESSION['user_id'])) {
                            $userId = $_SESSION['user_id'];
                          }

                          ?>
                          <button
                            class="fas fa-heart text-warning" id="like" userId="<?php echo $userId ?? '' ?>" articleId="<?php
                            echo $post->id;
                            ?>">
                          </button>
                          <small
                            class="text-muted" id="showCount">
                            <?php
                            echo $post->like_counts;
                            ?>
                          </small>
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
          <div class="card card-dark w-100">
            <div class="card-header">
              <h4>Comments</h4>
            </div>
            <div class="card-body">
              <!-- Loop Comment -->
              <form action="" method="post" id="form" article_id="<?php echo $post->id ?>">
                <div class="form-group">
                  <input type="text" id="cmt" class="form-control" placeholder="Comment Something">
                </div>
                <input type="submit" value="Comment" class="btn btn-outline-danger">
              </form>
              <div id="cmt_list"></div>
              <?php
              $cmts = Post::comments($post->id);
              ?>
              <?php foreach ($cmts as $cmt): ?>
              <div class="card-dark mt-1">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      <img src="<?php
             $u = DB::table('users')->where('id',$cmt->user_id)->getOne();
             echo $u->profile_img;
                      ?>"
                      style="width:50px;border-radius:50%"
                      alt="">

                    </div>
                    <div
                      class="col-md-4 d-flex align-items-center">

                      <?
                      $users = Post::user($cmt->user_id);
                      foreach ($users as $user) {
                        ?>
                        <?php echo $user->name; ?>
                        <?php
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
  let like = document.querySelector('#like');
  like.addEventListener('click', likeIt);
  function likeIt() {
    let userId = like.getAttribute('userId');
    let articleId = like.getAttribute('articleId');
    let showCount = document.querySelector('#showCount');
    if (userId == '') {
      location.href = "login.php"
    } else {
      axios.get(`like.php?userId=${userId}&articleId=${articleId}`).then((res)=> {
        if (res.data == 'liked') {
          toastr.warning('You have already liked!')
        }
        if (Number.isInteger(res.data)) {
          showCount.innerHTML = res.data;
          toastr.success('You Liked Successfilly!')
        }
      })
    }
  }

  // Comment

  let cmt_list = document.querySelector("#cmt_list");
  let form = document.querySelector('#form');

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    let cmt = document.querySelector("#cmt");
    let data = new FormData();
    let article_id = form.getAttribute('article_id');
    data.append('comment', cmt.value)
    data.append('article_id', article_id)
    axios.post('comment.php', data)
    .then((res)=> {
      cmt_list.innerHTML = res.data;
      console.log(res.data);
    })
  });

</script>
<?php
require_once 'inc/footer.php';

?>