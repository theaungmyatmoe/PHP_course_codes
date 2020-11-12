<?php
/**
* User Class
*/
class User {

  // Check Auth Of User
  static function auth() {
    $sid = $_SESSION['user_id'];
    $db = DB::table('users')->where('id', $sid)->getOne();
    if ($db) {
      return $db;
    } else {
      return false;
    }
  }

  // Valide User Registeration

  function register($request) {
    if (!empty($request)) {
      $errors = [];
      if (empty($request['name'])) {
        $errors[] = "Name Should Not Empty!";
      }
      if (empty($request['email']) && filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email Should Not Empty And Valid!";
      }
      if (empty($request['password'])) {
        $errors[] = "Password Should Not Empty!";
      }
      if (DB::table('users')->where('email', $request['email'])->getOne()) {
        $errors[] = "Email Already Exists";
      }
      // If Error GT Zero return errors
      if (count($errors) > 0) {
        return $errors;
      } else {
        // Filter String To Prevent XSS
        $user = DB::create('users', [
          'name' => Helper::strFilter($request['name']),
          'email' => Helper::strFilter($request['email']),
          'password' => Helper::strFilter(password_hash($request['password'], PASSWORD_BCRYPT)
          )]);
        // Set Session And Return Success
        if ($user) {
          $_SESSION['user_id'] = $user->id;
          return 'success';
        }
      }
    }

  }

  // Validate Login

  function login($request) {
    if (isset($request)) {
      $email = Helper::strFilter($request['email']);
      $password = $request['password'];
      $errors = [];
      // Check Email
      if (empty($email)) {
        $errors[] = "Email Should Not Empty";
      }
      // Check password
      if (empty($password)) {
        $errors[] = "Pssword Should Not Empty";
      }
      $userByMail = DB::table('users')->where('email', $email)->getOne();
      $hashPass = $userByMail->password;
      // Verify Pass
      if (password_verify($password, $hashPass)) {
        $_SESSION['user_id'] = $userByMail->id;
        Helper::redirect('index');
      } else {
        $errors[] = "Email and Password Are Not Valid!";
      }
      return $errors;
    }
  }

}