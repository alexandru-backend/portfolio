<?php

  $base_dados = [
    "host" => "sql102.infinityfree.com",
    "dbname" => "if0_41382764_meditrust_bd",
    "user" => "if0_41382764",
    "pass" => "racicovschi2006",
  ];

  $pdo = new PDO("mysql:host=$base_dados[host];dbname=$base_dados[dbname];charset=utf8mb4;", $base_dados["user"], $base_dados["pass"]);

  function select_sql($sql){
    global $pdo;
    $consulta = $pdo->query($sql);
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
  }

  function select_sql_unico($sql){
    global $pdo;
    $consulta = $pdo->query($sql);
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    return $resultado;
  }

  function idu_sql($sql){
    global $pdo;
    $consulta = $pdo->query($sql);
  }

?>