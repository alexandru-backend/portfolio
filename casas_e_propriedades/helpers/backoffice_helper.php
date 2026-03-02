<?php

session_start();

function fazer_login($login, $senha){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM backoffice WHERE login = ?");
    $stmt->execute([$login]);
    $utilizador = $stmt->fetch(PDO::FETCH_ASSOC);

    if($utilizador && password_verify($senha, $utilizador['senha'])){
        $_SESSION["utilizador"] = $utilizador;
        return true;
    }

    return false;
}

function verificar_logado(){
  if(empty($_SESSION["utilizador"])){
    header("Location: index.php");
    exit;
  }
}

function logout(){
  session_destroy();
  header("Location: index.php");
  exit;
}

function get_last_insert_id(){
    global $pdo;
    return $pdo->lastInsertId();
}

?>