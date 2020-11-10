<?php

/**
* Post
*/
class Post
{

  public static function all() {
    $articles = DB::table("articles")->orderBy('id', 'DESC')->paginate(2);

    foreach ($articles['data'] as $key => $val) {
      $articles['data'][$key]->comment_counts = DB::table('comments')->where('article_id', $val->id)->count();
      $articles['data'][$key]->like_counts = DB::table('article_likes')->where('article_id', $val->id)->count();
    }
    return $articles;
  }
}