<?php

function get_carousel(){
  $resultado = select_sql("SELECT * FROM carousel ORDER BY posicao ASC");
  return $resultado;
}

function get_carousel_activo(){
  $resultado = select_sql("SELECT * FROM carousel WHERE activo = 'Sim' ORDER BY posicao ASC");
  return $resultado;
}

function get_carousel_especifico($id){
  $resultado = select_sql_unico("SELECT * FROM carousel WHERE id=$id LIMIT 1");
  return $resultado;
}
?>