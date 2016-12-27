<?php

  function connect() {
    $dsn = 'mysql:host=localhost; dbname=syu_db; charset=utf8;';
    $user = 'root';
    $pass = '0000';

    try{
      $db = new PDO($dsn, $user, $pass);
    } catch(PDOException $e){
      exit("접속불가 : {$e->getMessage()}");
    }

    return $db;

  }

 ?>
