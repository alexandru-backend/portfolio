<?php

function get_todos_predios(){
  $resultado = select_sql("SELECT * FROM predios ORDER BY posicao ASC");
  return $resultado;
}

function get_todos_predios_home(){
  $resultado = select_sql("SELECT * FROM predios WHERE mostrar_na_home=1 AND activo='Sim' ORDER BY posicao ASC");
  return $resultado;
}

function get_todos_predios_por_pai($id_projeto){
  $resultado = select_sql("SELECT * FROM predios WHERE id_projeto=$id_projeto");
  return $resultado;
}

function get_predio_especifico($id){
  $resultado = select_sql_unico("SELECT * FROM predios WHERE id=$id LIMIT 1");
  return $resultado;
}

function get_predio_especifico_activo($id){
  $resultado = select_sql_unico("SELECT * FROM predios WHERE activo='Sim' AND id=$id LIMIT 1");
  return $resultado;
}

function get_predio_imagens($id){
  $resultado = select_sql_unico("SELECT * FROM predio_imagens WHERE id_predio=$id");
  return $resultado;
}

function contar_predios_home($id){
  $resultado = select_sql_unico("SELECT COUNT(*) as total FROM predios WHERE mostrar_na_home = 1 AND id_projeto = $id");
  return $resultado['total'] ?? 0;
}

function get_imagens_pagina($id, $pagina){
  $elementos_por_pagina = 4;
  $total = get_total_imagens($id);
  $total_paginas = ceil($total / $elementos_por_pagina);

  $resultado = select_sql_unico("SELECT imagens FROM predio_imagens WHERE id_predio=$id");
  $imagens = json_decode($resultado["imagens"]);

  return array_slice($imagens, (($pagina-1) * $elementos_por_pagina), $elementos_por_pagina);
}

function get_total_imagens($id){
  $resultado = select_sql_unico("SELECT imagens FROM predio_imagens WHERE id_predio=$id");
  $imagens = json_decode($resultado["imagens"]);
  return count($imagens);
}

?>