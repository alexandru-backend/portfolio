<?php 
require_once "../components/head.php";

$id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;

  $item = select_sql("SELECT posicao FROM predios WHERE id=$id");
  if(!empty($item)){
      $posicao = $item[0]['posicao'];

      idu_sql("DELETE FROM predio_imagens WHERE id_predio = $id");
      idu_sql("DELETE FROM predios WHERE id=$id");

      idu_sql("UPDATE predios SET posicao = posicao - 1 WHERE posicao > $posicao");
  }


header("Location: ../predios.php");
exit;
?>
