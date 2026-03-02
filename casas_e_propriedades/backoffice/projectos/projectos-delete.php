<?php 
require_once "../components/head.php";

$id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;

  $item = select_sql("SELECT posicao FROM projetos WHERE id=$id");
  if(!empty($item)){
      $posicao = $item[0]['posicao'];

      idu_sql("DELETE FROM projetos WHERE id=$id");

      idu_sql("UPDATE projetos SET posicao = posicao - 1 WHERE posicao > $posicao");
  }


header("Location: ../projectos.php");
exit;
?>
