<?php
require_once 'core/autoload.php';
?>
<!doctype html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--  Font Awesome for Bootstrap fonts and icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

  <!-- Material Design for Bootstrap CSS -->
  <link rel="stylesheet"
  href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
  integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX"
  crossorigin="anonymous">
  <link rel="stylesheet" href="assets/style/style.css">
  <link rel="stylesheet" href="  https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css
  ">
  <script src="app.js"></script>
  <script>
    var vConsole = new VConsole();
  </script>
  <title>MM-Coder</title>
  <style>

  </style>
</head>

<body>
  <!-- Start Nav -->
  <nav class="navbar navbar-expand-md">
    <a class="navbar-brand text-warning" href="index.php">Blogging!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Articles</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            if (!User::auth()) {
              ?>
              <a class="dropdown-item" href="#">Login</a>
              <a class="dropdown-item" href="#">Register</a>
              <?php
            } else {
              ?>
              <a class="dropdown-item" href="#">Welcome <?echo User::auth()->name; ?></a>
              <a class="dropdown-item" href="profile.php?user=<?php echo User::auth()->slug;
                ?>">Edit Profile</a>
              <a class="dropdown-item" href="logout.php">Logout</a>

              <?php
            }
            ?>
          </div>
        </li>
        <?php
        if (User::auth()) {
          ?>
                  <li class="nav-item">
          <a class="nav-link" href="index.php?owner=<? echo User::auth()->slug; ?>">My Articles</a>
        </li>

          <li class="nav-item ml-5">
            <a class="nav-link btn btn-sm  btn-warning" href="create.php">
              <i class="fas fa-plus"></i>
              Create Article</a>
          </li>
          <?php
        }
        ?>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search"
        aria-label="Search" name="search" id="search" autocomplete="off">
        <a class="btn btn-outline-success my-2 my-sm-0" onclick="searchIt">Search</a>
      </form>
    </div>
  </nav>

  <!-- Start Header -->

  <div class="jumbotron jumbotron-fluid header">
    <div class="container">
      <h1 class="text-white">MM-Coder Online Course</h1>
      <h1 class="display-4 text-white">Welcome Com From Advance PHP Online Class</h1>
      <p class="lead text-white">
        Hello Now We publish this course free.
      </p>
      <br>
      <?php
      if (!User::auth()) {
        ?>
        <a href="register.php" class="btn btn-warning">Create Account</a>
        <a href="login.php" class="btn btn-outline-success">Login</a>
        <?php
      }
      ?>

    </div>
  </div>

  <!-- Content -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 pr-3 pl-3">
        <!-- Category List -->
        <div class="card card-dark">
          <div class="card-header">
            <h4>All Category</h4>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <?php

              $sql = "SELECT *,
(SELECT COUNT(id) FROM articles
WHERE category_id=categories.id
) as cat_counts
FROM categories";
              $categories = DB::raw($sql);
              foreach ($categories as $cat) {
                ?>

                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="index.php?category=<? echo $cat['slug']; ?>">
                    <?php echo $cat['name']; ?>
                  </a>
                  <span class="badge badge-primary badge-pill"><?
                    echo $cat['cat_counts'];
                    ?></span>
                </li>


                <?php
              }
              ?>


            </ul>
          </div>

        </div>
        <hr>
        <!-- Language List -->
        <div class="card card-dark">
          <div class="card-header">
            <h4>All Languages</h4>
          </div>

          <div class="card-body">
            <ul class="list-group">

              <?php
              $qry = "SELECT *,
(SELECT COUNT(id) FROM article_language
WHERE language_id=languages.id
) as language_counts
FROM
languages";
              $langs = DB::raw($qry);
              foreach ($langs as $lang) {
                ?>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="index.php?language=<?php echo $lang['slug']; ?>">
                    <?php
                    echo $lang['name'];
                    ?>
                  </a>
                  <span class="badge badge-primary badge-pill"><?php
                    echo $lang['language_counts'];
                    ?></span>
                </li>

                <?php
              }
              ?>
            </ul>
          </div>

        </div>
      </div>

      <!-- Content -->
      <div class="col-md-8">
        