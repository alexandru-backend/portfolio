<?php

function get_portfolio_dropdown(){
  $resultado = select_sql("SELECT id, nome FROM portfolio WHERE activo='Sim'");
  return $resultado;
}

function get_todos_portfolios(){
  $resultado = select_sql("SELECT portfolio.*, (SELECT portfolio_imagens.imagens FROM portfolio_imagens WHERE portfolio_imagens.id_portfolio = portfolio.id ORDER BY portfolio_imagens.id ASC LIMIT 1) AS imagens FROM portfolio ORDER BY posicao ASC");
  return $resultado;
}


function get_portfolio_especifico($id){
  $resultado = select_sql_unico("SELECT * FROM portfolio WHERE id=$id LIMIT 1");
  return $resultado;
}

function get_portfolio_especifico_activo($id){
  $resultado = select_sql_unico("SELECT * FROM portfolio WHERE activo='Sim' AND id=$id LIMIT 1");
  return $resultado;
}

function get_portfolio_imagens($id){
  $resultado = select_sql_unico("SELECT * FROM portfolio_imagens WHERE  id_portfolio=$id LIMIT 1");
  return $resultado;
}


?>