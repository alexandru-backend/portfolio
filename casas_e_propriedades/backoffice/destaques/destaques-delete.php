<?php 

  require_once "../components/head.php";

  $id = !empty($_GET["id"]) ? intval($_GET["id"]) : 0;

  if($id){
    $item = select_sql("SELECT posicao FROM predios WHERE id=$id AND mostrar_na_home=1");

    if(!empty($item)){
        $posicao = $item[0]['posicao'];

        idu_sql("UPDATE predios SET mostrar_na_home=0 WHERE id=$id");

        idu_sql("UPDATE predios SET posicao = posicao - 1 WHERE mostrar_na_home=1 AND posicao > $posicao");
    }
  }

  header("Location: ../destaques.php");
  exit;

?>
