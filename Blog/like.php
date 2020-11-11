<?php
require_once 'core/autoload.php';
$request = $_GET;
if (isset($request)) {
  $userId = $_REQUEST['userId'];
  $articleId = $_REQUEST['articleId'];
  $isExist = DB::table('article_likes')->where('article_id', $articleId)->andWhere('user_id', $userId)->getOne();
  if (!$isExist) {

    DB::create('article_likes', [
      'user_id' => $userId,
      'article_id' => $articleId
    ]);

    $articleId = $_REQUEST['articleId'];
    $counts = DB::table('article_likes')->where('article_id', $articleId)->count();
    echo $counts;
  } else {
    echo 'liked';
  }

}



?>