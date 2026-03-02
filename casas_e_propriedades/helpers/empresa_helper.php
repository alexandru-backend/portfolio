<?php

function get_empresas(){
  $resultado = select_sql("SELECT * FROM empresas ORDER BY posicao ASC");
  return $resultado;
}

function get_empresa($id){
  $resultado = select_sql_unico("SELECT * FROM empresas WHERE id = $id");
  return $resultado;
}

function get_empresa_activo($id){
  $resultado = select_sql_unico("SELECT * FROM empresas WHERE activo='Sim' AND id = $id");
  return $resultado;
}

function get_empresa_dropdown(){
  $resultado = select_sql("SELECT id, nome FROM empresas WHERE activo='Sim'");
  return $resultado;
}

?>