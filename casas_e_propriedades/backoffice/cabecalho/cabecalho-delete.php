<?php 
require_once "../components/head.php";

$id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;

  $item = select_sql("SELECT posicao FROM carousel WHERE id=$id");
  if(!empty($item)){
      $posicao = $item[0]['posicao'];

      idu_sql("DELETE FROM carousel WHERE id=$id");

      idu_sql("UPDATE carousel SET posicao = posicao - 1 WHERE posicao > $posicao");
  }


header("Location: ../cabecalho.php");
exit;
?>
