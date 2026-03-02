<?php

function get_projetos_dropdown(){
  $resultado = select_sql("SELECT id, nome FROM projetos WHERE activo='Sim'");
  return $resultado;
}

function get_projeto_especifico($id){
  $resultado = select_sql_unico("SELECT * FROM projetos WHERE id=$id LIMIT 1");
  return $resultado;
}

function get_projeto_especifico_activo($id){
  $resultado = select_sql_unico("SELECT * FROM projetos WHERE activo='Sim' AND id=$id LIMIT 1");
  return $resultado;
}

function get_projetos(){
  $resultado = select_sql("SELECT * FROM projetos ORDER BY posicao ASC");
  return $resultado;
}


?>