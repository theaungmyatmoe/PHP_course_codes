<?php
require_once 'core/autoload.php';

$request = $_POST;
if (isset($request)) {
  $articleId = $_POST['article_id'];
  $comment = $_POST['comment'];
  // Comment Create
  $cmt = DB::create('comments',[
     'user_id'=>User::auth()->id,
     'article_id'=>$articleId,
     'content'=>$comment
     ]);
 $showCmt = DB::table('comments')->where('id',$cmt->id)->getOne();
  $user = DB::table('users')->where('id',$showCmt->user_id)->getOne();
  $str = "<div class='card-dark mt-1'>
<div class='card-body'>
<div class='row'>
<div class='col-md-1'>
<img src='{$user->profile_img}'
style='width:50px;border-radius:50%'
alt=''>

</div>
<div
class='col-md-4 d-flex align-items-center'>
{$user->name}
hi
</div>
</div>
<hr>
<p>
{$showCmt->content}
</p>
</div>
</div>";
echo $str;
}


?>