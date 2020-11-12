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
  static function detail($slug) {
    $article = DB::table('articles')->where('slug', $slug)->getOne();
    $article->like_counts = DB::table('article_likes')->where('article_id', $article->id)->count();
    $article->comment_counts = DB::table('comments')->where('article_id', $article->id)->count();
    return $article;
    //echo '<pre>';
    // print_r($article);
  }
  static function category($id) {
    return DB::table('categories')->where('id', $id)->getOne();

  }
  static function comments($id) {
    $cmts = DB::table('comments')->where('article_id', $id)->get();
    //print_r($cmts);
    return $cmts;
  }
  static function user($id) {
    $users = DB::table('users')->where('id', $id)->get();
    return $users;
  }
  // Cat by slug
  static function catBySlug($slug) {
    $id = DB::table('categories')->where('slug', $slug)->getOne()->id;
    $articles = DB::table("articles")->where('category_id', $id)->orderBy('id', 'DESC')->paginate(2, "category=$slug");

    foreach ($articles['data'] as $key => $val) {
      $articles['data'][$key]->comment_counts = DB::table('comments')->where('article_id', $val->id)->count();
      $articles['data'][$key]->like_counts = DB::table('article_likes')->where('article_id', $val->id)->count();
    }
    return $articles;
  }

  static function langBySlug($slug) {

    $lang = DB::table('languages')->where('slug', $slug)->getOne();
    $id = $lang->id;
    $sql = "SELECT * FROM article_language INNER JOIN articles ON article_language.article_id=articles.id WHERE article_language.id=1";
    $articles = DB::raw($sql);
    return $articles;
    
  }
}