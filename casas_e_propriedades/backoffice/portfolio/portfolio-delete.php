<?php 
require_once "../components/head.php";

$id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;

  $item = select_sql("SELECT posicao FROM portfolio WHERE id=$id");
  if(!empty($item)){
      $posicao = $item[0]['posicao'];

      idu_sql("DELETE FROM portfolio_imagens WHERE id_predio = $id");
      idu_sql("DELETE FROM portfolio WHERE id=$id");

      idu_sql("UPDATE portfolio SET posicao = posicao - 1 WHERE posicao > $posicao");
  }


header("Location: ../portfolio.php");
exit;
?>
