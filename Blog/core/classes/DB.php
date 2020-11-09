<?php

// This is not singleton pattern

class DB {
  //connection , fetched datas , statement , counting , query
  private static
  $conn,
  $data,
  $stmt,
  $count,
  $qry;

  // start when class is invoke

  function __construct() {
    try {
      self::$conn = new \PDO("mysql:host=localhost;dbname=mtk_course", "root", "");
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e) {
      return $e->getMessage();
    }
  }

  // get query from table

  function query($params = []) {
    self::$stmt = self::$conn->prepare(self::$qry);
    self::$stmt->execute($params);
    return $this;
  }


  static function raw($qry) {
    $db = new DB();
    self::$qry = $qry;
    return $db;
  }


  // get all rows from query and return

  function get() {
    self::$data = self::$stmt->fetchAll(PDO::FETCH_OBJ);

    return self::$data;
  }

  // get one row

  function getOne() {
    self::$data = self::$stmt->fetch(PDO::FETCH_OBJ);
    return self::$data;
  }

  // count rows

  function countIt() {
    self::$count = self::$stmt->rowCount();
    return self::$count;
  }

  //get table name

  static function table($tableName) {

    // get query

    self::$qry = "SELECT * FROM {$tableName}";
    // invoke non-static mehod in static methods
    $db = new DB();
    $db->query();
    //return this class
    return $db;

  }

  // order method

  function orderBy($fieldName, $val) {
    self::$qry .= " ORDER BY {$fieldName} {$val}";
    echo self::$qry;
    $this->query();
    return $this;
  }

  // where method
  //overloading method to prevent errors
  function where($param1, $param2, $param3 = '') {

    //check funtion params

    if (func_num_args() == 2) {
      self::$qry .= " WHERE $param1='$param2'";
    } else {
      self::$qry .= " WHERE $param1 $param2 '$param3'";
    }
    // override and return class

    $this->query();
    return $this;
  }

  // and where

  function andWhere($param1, $param2, $param3 = '') {

    //check funtion params

    if (func_num_args() == 2) {
      self::$qry .= " AND $param1='$param2'";
    } else {
      self::$qry .= " AND $param1 $param2 '$param3'";
    }

    // override and return class
    //echo self::$qry;
    $this->query();
    return $this;
  }

  // OR Clause
  function orWhere($param1, $param2, $param3 = '') {

    //check funtion params

    if (func_num_args() == 2) {
      self::$qry .= " OR $param1='$param2'";
    } else {
      self::$qry .= " OR $param1 $param2 '$param3'";
    }

    // override and return class
    //echo self::$qry;
    $this->query();
    return $this;
  }

  // Create method

  static function create($tableName, $data = []) {
    $db = new DB();
    //split array key by semicolumn

    $colNames = implode(',', array_keys($data));
    $binds = '';
    foreach ($data as $d) {
      $binds .= '?';
    }
    // string split
    $binds = str_split($binds);
    $binds = implode(',', $binds);
    $qry = "INSERT INTO $tableName ($colNames) VALUES ($binds)";
    self::$qry = $qry;
    $db->query(array_values($data));
    $id = self::$conn->lastInsertId();
    return DB::table($tableName)->where('id', $id)->getOne();
  }
  static function update($tableName, $data, $id) {
    $db = new DB();
    $qry = "UPDATE $tableName SET ";
    $binds = '';
    $x = 1;
    // split key value and add to query method
    foreach ($data as $key => $val) {
      $qry .= "$key=?";
      if ($x < count($data)) {
        $qry .= ',';
        $x++;
      }
    }
    $qry .= " WHERE id=$id";
    self::$qry = $qry;
    $db->query(array_values($data));
    return DB::table($tableName)->where('id', $id)->getOne();
  }

  function delete($tableName, $id) {
    $qry = "DELETE FROM {$tableName} WHERE id={$id}";
    $db = new DB();
    self::$qry = $qry;
    $db->query();
    return true;
  }
  function paginate($pageRecord) {
    if (isset($_GET['page'])) {
      if (!is_numeric($_GET['page'])) {
        $_GET['page'] = 1;
      }
    }
    if (empty($_GET['page'])) {
      $_GET['page'] = 1;
    }
    if ($_GET['page'] < 0) {
      $_GET['page'] = 1;
    }

    $total = self::$stmt->rowCount();
    $pageNo = $_GET['page'];
    $prev_page = $pageNo - 1;
    $next_page = $pageNo + 1;
    // limit anmous number
    $limit;
    $limit = ($pageNo-0)*$pageRecord;
    self::$qry .= " LIMIT $limit,$pageRecord";
    $this->query();
    self::$data = self::$stmt->fetchAll(PDO::FETCH_OBJ);
    $data = [
      'pdata' => self::$data,
      'total' => $total,
      'prev_page' => '?page='.$prev_page,
      'next_page' => '?page='.$next_page
    ];
    return $data;
  }


}